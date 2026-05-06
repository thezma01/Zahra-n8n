'use strict';

const mongoose = require('mongoose');

const permissionSchema = new mongoose.Schema(
  {
    key: {
      type: String,
      required: [true, 'Permission key is required'],
      unique: true,
      trim: true,
      lowercase: true,
      match: [/^[a-z_]+$/, 'Permission key must contain only lowercase letters and underscores'],
    },

    label: {
      type: String,
      required: [true, 'Permission label is required'],
      trim: true,
      maxlength: [100, 'Label must not exceed 100 characters'],
    },

    description: {
      type: String,
      trim: true,
      maxlength: [500, 'Description must not exceed 500 characters'],
      default: '',
    },

    category: {
      type: String,
      trim: true,
      enum: ['orders', 'reports', 'admin', 'payments', 'auth'],
      default: 'orders',
    },

    isActive: {
      type: Boolean,
      default: true,
    },
  },
  {
    timestamps: true,
    toJSON: { virtuals: true },
    toObject: { virtuals: true },
  }
);

permissionSchema.index({ key: 1 }, { unique: true });
permissionSchema.index({ category: 1 });
permissionSchema.index({ isActive: 1 });

permissionSchema.statics.getActivePermissions = function () {
  return this.find({ isActive: true }).sort({ category: 1, label: 1 });
};

permissionSchema.statics.seedDefaultPermissions = async function (defaultPermissions) {
  const ops = defaultPermissions.map((perm) => ({
    updateOne: {
      filter: { key: perm.key },
      update: { $setOnInsert: perm },
      upsert: true,
    },
  }));
  return this.bulkWrite(ops);
};

const Permission = mongoose.model('Permission', permissionSchema);

module.exports = Permission;
