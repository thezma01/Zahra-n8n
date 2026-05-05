'use strict';

const { DataTypes, Model } = require('sequelize');
const bcrypt = require('bcryptjs');
const { sequelize } = require('../database/connection');

class User extends Model {
  /**
   * Verify a plain-text PIN against the stored hash.
   * @param {string} plainPin
   * @returns {Promise<boolean>}
   */
  async verifyPin(plainPin) {
    return bcrypt.compare(String(plainPin), this.pinHash);
  }

  /**
   * Returns a safe public representation (no pin hash, no OTP).
   * @returns {object}
   */
  toPublicJSON() {
    return {
      id: this.id,
      name: this.name,
      email: this.email,
      role: this.role,
      avatarUrl: this.avatarUrl,
      initials: this.initials,
      isActive: this.isActive,
      lastLoginAt: this.lastLoginAt,
    };
  }

  /**
   * Computed initials from name.
   * @returns {string}
   */
  get initials() {
    if (!this.name) return '??';
    const parts = this.name.trim().split(/\s+/);
    if (parts.length === 1) return parts[0].substring(0, 2).toUpperCase();
    return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
  }
}

User.init(
  {
    id: {
      type: DataTypes.UUID,
      defaultValue: DataTypes.UUIDV4,
      primaryKey: true,
    },
    name: {
      type: DataTypes.STRING(150),
      allowNull: false,
      validate: { notEmpty: true, len: [2, 150] },
    },
    email: {
      type: DataTypes.STRING(255),
      allowNull: false,
      unique: true,
      validate: { isEmail: true },
    },
    pinHash: {
      type: DataTypes.STRING(255),
      allowNull: false,
      field: 'pin_hash',
    },
    role: {
      type: DataTypes.ENUM('manager', 'cashier'),
      allowNull: false,
      defaultValue: 'cashier',
    },
    avatarUrl: {
      type: DataTypes.STRING(500),
      allowNull: true,
      field: 'avatar_url',
    },
    isActive: {
      type: DataTypes.BOOLEAN,
      defaultValue: true,
      field: 'is_active',
    },
    failedPinAttempts: {
      type: DataTypes.INTEGER,
      defaultValue: 0,
      field: 'failed_pin_attempts',
    },
    lockedUntil: {
      type: DataTypes.DATE,
      allowNull: true,
      field: 'locked_until',
    },
    lastLoginAt: {
      type: DataTypes.DATE,
      allowNull: true,
      field: 'last_login_at',
    },
    otpHash: {
      type: DataTypes.STRING(255),
      allowNull: true,
      field: 'otp_hash',
    },
    otpExpiresAt: {
      type: DataTypes.DATE,
      allowNull: true,
      field: 'otp_expires_at',
    },
    otpAttempts: {
      type: DataTypes.INTEGER,
      defaultValue: 0,
      field: 'otp_attempts',
    },
  },
  {
    sequelize,
    modelName: 'User',
    tableName: 'users',
    underscored: true,
    timestamps: true,
    paranoid: true, // soft deletes
    hooks: {
      async beforeCreate(user) {
        if (user.pinHash && !user.pinHash.startsWith('$2')) {
          user.pinHash = await bcrypt.hash(String(user.pinHash), 12);
        }
      },
      async beforeUpdate(user) {
        if (user.changed('pinHash') && !user.pinHash.startsWith('$2')) {
          user.pinHash = await bcrypt.hash(String(user.pinHash), 12);
        }
      },
    },
  }
);

module.exports = User;
