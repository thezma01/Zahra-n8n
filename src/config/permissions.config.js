'use strict';

/**
 * Role-permission mapping.
 * Stored here as defaults; overridable from DB via admin portal.
 * Each permission key maps to a human-readable label and default roles.
 */
const PERMISSIONS = {
  // Order Management
  PLACE_ORDER: {
    key: 'PLACE_ORDER',
    label: 'Place Orders',
    defaultRoles: ['manager', 'cashier'],
  },
  HOLD_ORDER: {
    key: 'HOLD_ORDER',
    label: 'Hold Orders',
    defaultRoles: ['manager', 'cashier'],
  },
  VOID_ORDER: {
    key: 'VOID_ORDER',
    label: 'Void / Cancel Orders',
    defaultRoles: ['manager'],
  },

  // Payment
  APPLY_DISCOUNT: {
    key: 'APPLY_DISCOUNT',
    label: 'Apply Discount',
    defaultRoles: ['manager', 'cashier'],
  },
  SPLIT_PAYMENT: {
    key: 'SPLIT_PAYMENT',
    label: 'Split Payment',
    defaultRoles: ['manager', 'cashier'],
  },

  // Reporting
  VIEW_REPORTS: {
    key: 'VIEW_REPORTS',
    label: 'View Reports',
    defaultRoles: ['manager'],
  },

  // Batch / Session
  BATCH_OPEN: {
    key: 'BATCH_OPEN',
    label: 'Open Batch',
    defaultRoles: ['manager'],
  },
  BATCH_CLOSE: {
    key: 'BATCH_CLOSE',
    label: 'Close Batch',
    defaultRoles: ['manager'],
  },

  // User Management
  MANAGE_USERS: {
    key: 'MANAGE_USERS',
    label: 'Manage Users',
    defaultRoles: ['manager'],
  },

  // PIN Management
  RESET_ANY_PIN: {
    key: 'RESET_ANY_PIN',
    label: 'Reset Any User PIN',
    defaultRoles: ['manager'],
  },
  FORGOT_PIN: {
    key: 'FORGOT_PIN',
    label: 'Forgot PIN (Email OTP)',
    defaultRoles: ['manager'],
  },
};

const ROLES = {
  MANAGER: 'manager',
  CASHIER: 'cashier',
};

/**
 * Returns default permissions array for a given role string.
 * @param {string} role
 * @returns {string[]}
 */
function getDefaultPermissionsForRole(role) {
  return Object.values(PERMISSIONS)
    .filter((p) => p.defaultRoles.includes(role))
    .map((p) => p.key);
}

module.exports = { PERMISSIONS, ROLES, getDefaultPermissionsForRole };
