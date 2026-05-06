import mongoose, { Document, Schema, Types } from 'mongoose';

export type RoleType = 'manager' | 'cashier';

export interface IRole extends Document {
  name: RoleType;
  label: string;
  description: string;
  permissions: Types.ObjectId[];
  isActive: boolean;
  isSystem: boolean;
  createdAt: Date;
  updatedAt: Date;
}

const RoleSchema = new Schema<IRole>(
  {
    name: {
      type: String,
      required: [true, 'Role name is required'],
      unique: true,
      trim: true,
      lowercase: true,
      enum: {
        values: ['manager', 'cashier'],
        message: 'Role must be either manager or cashier',
      },
    },
    label: {
      type: String,
      required: [true, 'Role label is required'],
      trim: true,
      maxlength: [50, 'Label cannot exceed 50 characters'],
    },
    description: {
      type: String,
      trim: true,
      maxlength: [500, 'Description cannot exceed 500 characters'],
      default: '',
    },
    permissions: [
      {
        type: Schema.Types.ObjectId,
        ref: 'Permission',
      },
    ],
    isActive: {
      type: Boolean,
      default: true,
    },
    isSystem: {
      type: Boolean,
      default: false,
    },
  },
  {
    timestamps: true,
    versionKey: false,
    toJSON: {
      transform: (_doc, ret) => {
        ret.id = ret._id;
        delete ret._id;
        return ret;
      },
    },
  }
);

RoleSchema.index({ name: 1 }, { unique: true });

export const Role = mongoose.model<IRole>('Role', RoleSchema);

export default Role;
