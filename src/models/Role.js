'use strict';

const mongoose = require('mongoose');

const roleSchema = new mongoose.Schema(
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
      maxlength: [50, 'Label must not exceed 50 characters'],
    },

    permissions: [
      {
        type: String,
        trim: true,
        lowercase: true,
      },
    ],

    badgeColor: {
      type: String,
      default: '#6b7280',
      trim: true,
    },

    isActive: {
      type: Boolean,
      default: true,
    },

    description: {
      type: String,
      trim: true,
      maxlength: [300, 'Description must not exceed 300 characters'],
      default: '',
    },
  },
  {
    timestamps: true,
    toJSON: { virtuals: true },
    toObject: { virtuals: true },
  }
);

roleSchema.index({ name: 1 }, { unique: true });
roleSchema.index({ isActive: 1 });

roleSchema.methods.hasPermission = function (permissionKey) {
  return this.permissions.includes(permissionKey.toLowerCase());
};

roleSchema.methods.addPermission = function (permissionKey) {
  const key = permissionKey.toLowerCase();
  if (!this.permissions.includes(key)) {
    this.permissions.push(key);
  }
  return this;
};

roleSchema.methods.removePermission = function (permissionKey) {
  const key = permissionKey.toLowerCase();
  this.permissions = this.permissions.filter((p) => p !== key);
  return this;
};

roleSchema.statics.seedDefaultRoles = async function (defaultRoles) {
  const ops = defaultRoles.map((role) => ({
    updateOne: {
      filter: { name: role.name },
      update: { $setOnInsert: role },
      upsert: true,
    },
  }));
  return this.bulkWrite(ops);
};

const Role = mongoose.model('Role', roleSchema);

module.exports = Role;
