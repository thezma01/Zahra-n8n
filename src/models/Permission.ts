import mongoose, { Document, Schema } from 'mongoose';

export interface IPermission extends Document {
  key: string;
  label: string;
  description: string;
  module: string;
  isActive: boolean;
  createdAt: Date;
  updatedAt: Date;
}

const PermissionSchema = new Schema<IPermission>(
  {
    key: {
      type: String,
      required: [true, 'Permission key is required'],
      unique: true,
      trim: true,
      lowercase: true,
      match: [
        /^[a-z_]+$/,
        'Permission key must contain only lowercase letters and underscores',
      ],
    },
    label: {
      type: String,
      required: [true, 'Permission label is required'],
      trim: true,
      maxlength: [100, 'Label cannot exceed 100 characters'],
    },
    description: {
      type: String,
      trim: true,
      maxlength: [500, 'Description cannot exceed 500 characters'],
      default: '',
    },
    module: {
      type: String,
      required: [true, 'Module is required'],
      trim: true,
      lowercase: true,
      enum: {
        values: ['auth', 'orders', 'reports', 'batch', 'users', 'settings'],
        message: 'Invalid module: {VALUE}',
      },
    },
    isActive: {
      type: Boolean,
      default: true,
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

PermissionSchema.index({ key: 1 }, { unique: true });
PermissionSchema.index({ module: 1 });

export const Permission = mongoose.model<IPermission>(
  'Permission',
  PermissionSchema
);

export const DEFAULT_PERMISSIONS = [
  {
    key: 'forget_pin',
    label: 'Forget PIN',
    description: 'Allow user to reset PIN via email OTP',
    module: 'auth',
  },
  {
    key: 'void_orders',
    label: 'Void / Cancel Orders',
    description: 'Allow user to void or cancel placed orders',
    module: 'orders',
  },
  {
    key: 'view_reports',
    label: 'View Reports',
    description: 'Allow user to access sales and analytics reports',
    module: 'reports',
  },
  {
    key: 'batch_open_close',
    label: 'Batch Open / Close',
    description: 'Allow user to open and close batch sessions',
    module: 'batch',
  },
  {
    key: 'place_orders',
    label: 'Place Orders',
    description: 'Allow user to create and place new orders',
    module: 'orders',
  },
  {
    key: 'hold_orders',
    label: 'Hold Orders',
    description: 'Allow user to place orders on hold',
    module: 'orders',
  },
  {
    key: 'apply_discount',
    label: 'Apply Discount',
    description: 'Allow user to apply discounts to orders',
    module: 'orders',
  },
  {
    key: 'split_payment',
    label: 'Split Payment',
    description: 'Allow user to split payments across methods',
    module: 'orders',
  },
];

export default Permission;
