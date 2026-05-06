import mongoose, { Document, Schema, Types } from 'mongoose';
import bcrypt from 'bcryptjs';

export interface IOtpEntry {
  code: string;
  expiresAt: Date;
  isUsed: boolean;
  createdAt: Date;
}

export interface IUser extends Document {
  _id: Types.ObjectId;
  name: string;
  email: string;
  pin: string;
  role: Types.ObjectId;
  avatar?: string;
  initials: string;
  isActive: boolean;
  failedPinAttempts: number;
  lockedUntil?: Date;
  otp?: IOtpEntry;
  lastLoginAt?: Date;
  createdAt: Date;
  updatedAt: Date;

  // Methods
  comparePin(candidatePin: string): Promise<boolean>;
  isLockedOut(): boolean;
  incrementFailedAttempts(maxAttempts: number, lockoutMinutes: number): Promise<void>;
  resetFailedAttempts(): Promise<void>;
  generateInitials(): string;
}

const OtpSchema = new Schema<IOtpEntry>(
  {
    code: { type: String, required: true },
    expiresAt: { type: Date, required: true },
    isUsed: { type: Boolean, default: false },
    createdAt: { type: Date, default: Date.now },
  },
  { _id: false }
);

const UserSchema = new Schema<IUser>(
  {
    name: {
      type: String,
      required: [true, 'Name is required'],
      trim: true,
      minlength: [2, 'Name must be at least 2 characters'],
      maxlength: [100, 'Name cannot exceed 100 characters'],
    },
    email: {
      type: String,
      required: [true, 'Email is required'],
      unique: true,
      trim: true,
      lowercase: true,
      match: [
        /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        'Please provide a valid email address',
      ],
    },
    pin: {
      type: String,
      required: [true, 'PIN is required'],
      select: false,
    },
    role: {
      type: Schema.Types.ObjectId,
      ref: 'Role',
      required: [true, 'Role is required'],
    },
    avatar: {
      type: String,
      trim: true,
      default: undefined,
    },
    initials: {
      type: String,
      trim: true,
      maxlength: [3, 'Initials cannot exceed 3 characters'],
    },
    isActive: {
      type: Boolean,
      default: true,
    },
    failedPinAttempts: {
      type: Number,
      default: 0,
      min: 0,
    },
    lockedUntil: {
      type: Date,
      default: undefined,
    },
    otp: {
      type: OtpSchema,
      default: undefined,
      select: false,
    },
    lastLoginAt: {
      type: Date,
      default: undefined,
    },
  },
  {
    timestamps: true,
    versionKey: false,
    toJSON: {
      transform: (_doc, ret) => {
        ret.id = ret._id;
        delete ret._id;
        delete ret.pin;
        delete ret.otp;
        return ret;
      },
    },
  }
);

// ─── Indexes ─────────────────────────────────────────────────────────────────
UserSchema.index({ email: 1 }, { unique: true });
UserSchema.index({ role: 1 });
UserSchema.index({ isActive: 1 });

// ─── Pre-save Hook: Hash PIN + Generate Initials ─────────────────────────────
UserSchema.pre('save', async function (next) {
  if (this.isModified('pin')) {
    const salt = await bcrypt.genSalt(12);
    this.pin = await bcrypt.hash(this.pin, salt);
  }

  if (this.isModified('name') || !this.initials) {
    this.initials = this.generateInitials();
  }

  next();
});

// ─── Methods ─────────────────────────────────────────────────────────────────
UserSchema.methods.comparePin = async function (
  candidatePin: string
): Promise<boolean> {
  return bcrypt.compare(candidatePin, this.pin);
};

UserSchema.methods.isLockedOut = function (): boolean {
  if (!this.lockedUntil) return false;
  return new Date() < this.lockedUntil;
};

UserSchema.methods.incrementFailedAttempts = async function (
  maxAttempts: number,
  lockoutMinutes: number
): Promise<void> {
  this.failedPinAttempts += 1;

  if (this.failedPinAttempts >= maxAttempts) {
    const lockUntil = new Date();
    lockUntil.setMinutes(lockUntil.getMinutes() + lockoutMinutes);
    this.lockedUntil = lockUntil;
    this.failedPinAttempts = 0;
  }

  await this.save();
};

UserSchema.methods.resetFailedAttempts = async function (): Promise<void> {
  this.failedPinAttempts = 0;
  this.lockedUntil = undefined;
  await this.save();
};

UserSchema.methods.generateInitials = function (): string {
  const parts = (this.name as string).trim().split(/\s+/);
  if (parts.length === 1) {
    return parts[0].substring(0, 2).toUpperCase();
  }
  return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
};

export const User = mongoose.model<IUser>('User', UserSchema);

export default User;
