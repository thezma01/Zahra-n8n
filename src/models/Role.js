'use strict';

const { DataTypes, Model } = require('sequelize');
const { sequelize } = require('../database/connection');
const { getDefaultPermissionsForRole } = require('../config/permissions.config');

class Role extends Model {
  /**
   * Check if this role has a specific permission key.
   * @param {string} permissionKey
   * @returns {boolean}
   */
  hasPermission(permissionKey) {
    const perms = Array.isArray(this.permissions) ? this.permissions : [];
    return perms.includes(permissionKey);
  }
}

Role.init(
  {
    id: {
      type: DataTypes.UUID,
      defaultValue: DataTypes.UUIDV4,
      primaryKey: true,
    },
    name: {
      type: DataTypes.STRING(50),
      allowNull: false,
      unique: true,
      validate: {
        isIn: [['manager', 'cashier']],
      },
    },
    label: {
      type: DataTypes.STRING(100),
      allowNull: false,
    },
    permissions: {
      type: DataTypes.JSON,
      allowNull: false,
      defaultValue: [],
    },
    isActive: {
      type: DataTypes.BOOLEAN,
      defaultValue: true,
      field: 'is_active',
    },
  },
  {
    sequelize,
    modelName: 'Role',
    tableName: 'roles',
    underscored: true,
    timestamps: true,
    hooks: {
      beforeCreate(role) {
        if (!role.permissions || role.permissions.length === 0) {
          role.permissions = getDefaultPermissionsForRole(role.name);
        }
        if (!role.label) {
          role.label =
            role.name.charAt(0).toUpperCase() + role.name.slice(1);
        }
      },
    },
  }
);

module.exports = Role;
