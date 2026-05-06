'use strict';

const mongoose = require('mongoose');
const bcrypt = require('bcryptjs');
const authConfig = require('../config/auth.config');

const otpSchema = new mongoose.Schema(
  {
    code: { type: String, required: true },
    expiresAt: { type: Date, required: true },
    attempts: { type: Number, default: 0 },
    used: { type: Boolean, default: false },
  },
  { _id: false }
);

const userSchema = new mongoose.Schema(
  {
    name: {
      type: String,
      required: [true, 'Name is required'],
      trim: true,
      minlength: [2, 'Name must be at least 2 characters'],
      maxlength: [100, 'Name must not exceed 100 characters'],
    },

    email: {
      type: String,
      required: [true, 'Email is required'],
      unique: true,
      trim: true,
      lowercase: true,
      match: [/^\S+@\S+\.\S+$/, 'Please provide a valid email address'],
    },

    pin: {
      type: String,
      required: [true, 'PIN is required'],
      select: false,
    },

    role: {
      type: String,
      required: [true, 'Role is required'],
      enum: {
        values: ['manager', 'cashier'],
        message: 'Role must be manager or cashier',
      },
      default: 'cashier',
    },

    avatarInitials: {
      type: String,
      trim: true,
      maxlength: [3, 'Initials must not exceed 3 characters'],
    },

    avatarColor: {
      type: String,
      default: '#16a34a',
      trim: true,
    },

    isActive: {
      type: Boolean,
      default: true,
    },

    failedPinAttempts: {
      type: Number,
      default: 0,
    },

    lockedUntil: {
      type: Date,
      default: null,
    },

    lastLoginAt: {
      type: Date,
      default: null,
    },

    otp: {
      type: otpSchema,
      default: null,
      select: false,
    },
  },
  {
    timestamps: true,
    toJSON: {
      virtuals: true,
      transform(doc, ret) {
        delete ret.pin;
        delete ret.otp;
        delete ret.__v;
        return ret;
      },
    },
    toObject: { virtuals: true },
  }
);

userSchema.index({ email: 1 }, { unique: true });
userSchema.index({ role: 1 });
userSchema.index({ isActive: 1 });

userSchema.virtual('initials').get(function () {
  if (this.avatarInitials) return this.avatarInitials;
  const parts = this.name.trim().split(' ');
  if (parts.length === 1) return parts[0].substring(0, 2).toUpperCase();
  return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
});

userSchema.virtual('isLocked').get(function () {
  if (!this.lockedUntil) return false;
  return new Date() < this.lockedUntil;
});

userSchema.pre('save', async function (next) {
  if (!this.isModified('pin')) return next();
  try {
    const saltRounds = authConfig.pin.saltRounds;
    this.pin = await bcrypt.hash(this.pin, saltRounds);
    return next();
  } catch (err) {
    return next(err);
  }
});

userSchema.pre('save', function (next) {
  if (!this.avatarInitials) {
    const parts = this.name.trim().split(' ');
    if (parts.length === 1) {
      this.avatarInitials = parts[0].substring(0, 2).toUpperCase();
    } else {
      this.avatarInitials = (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
    }
  }
  next();
});

userSchema.methods.comparePin = async function (candidatePin) {
  const user = await User.findById(this._id).select('+pin');
  return bcrypt.compare(candidatePin, user.pin);
};

userSchema.methods.incrementFailedAttempts = async function () {
  this.failedPinAttempts += 1;
  if (this.failedPinAttempts >= authConfig.pin.maxAttempts) {
    const lockoutMs = authConfig.pin.lockoutDurationMinutes * 60 * 1000;
    this.lockedUntil = new Date(Date.now() + lockoutMs);
    this.failedPinAttempts = 0;
  }
  return this.save();
};

userSchema.methods.resetFailedAttempts = async function () {
  this.failedPinAttempts = 0;
  this.lockedUntil = null;
  this.lastLoginAt = new Date();
  return this.save();
};

userSchema.methods.setOTP = async function (code) {
  const expiryMs = authConfig.otp.expiryMinutes * 60 * 1000;
  const hashedCode = await bcrypt.hash(code, 10);
  this.otp = {
    code: hashedCode,
    expiresAt: new Date(Date.now() + expiryMs),
    attempts: 0,
    used: false,
  };
  return this.save();
};

userSchema.methods.verifyOTP = async function (candidateCode) {
  const user = await User.findById(this._id).select('+otp');
  if (!user.otp || user.otp.used) return { valid: false, reason: 'No active OTP' };
  if (new Date() > user.otp.expiresAt) return { valid: false, reason: 'OTP has expired' };
  if (user.otp.attempts >= authConfig.otp.maxAttempts) {
    return { valid: false, reason: 'Too many OTP attempts' };
  }
  const match = await bcrypt.compare(candidateCode, user.otp.code);
  if (!match) {
    user.otp.attempts += 1;
    await user.save();
    return { valid: false, reason: 'Invalid OTP' };
  }
  user.otp.used = true;
  await user.save();
  return { valid: true };
};

userSchema.statics.getActiveUsers = function () {
  return this.find({ isActive: true })
    .select('name email role avatarInitials avatarColor lastLoginAt')
    .sort({ name: 1 });
};

const User = mongoose.model('User', userSchema);

module.exports = User;
