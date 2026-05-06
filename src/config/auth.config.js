'use strict';

require('dotenv').config();

const authConfig = {
  jwt: {
    secret: process.env.JWT_SECRET || 'pos-jwt-secret-change-in-production',
    expiresIn: process.env.JWT_EXPIRES_IN || '8h',
    refreshExpiresIn: process.env.JWT_REFRESH_EXPIRES_IN || '7d',
  },

  pin: {
    length: parseInt(process.env.PIN_LENGTH, 10) || 5,
    maxAttempts: parseInt(process.env.PIN_MAX_ATTEMPTS, 10) || 5,
    lockoutDurationMinutes: parseInt(process.env.PIN_LOCKOUT_MINUTES, 10) || 15,
    saltRounds: parseInt(process.env.BCRYPT_SALT_ROUNDS, 10) || 12,
  },

  otp: {
    length: parseInt(process.env.OTP_LENGTH, 10) || 6,
    expiryMinutes: parseInt(process.env.OTP_EXPIRY_MINUTES, 10) || 5,
    maxAttempts: parseInt(process.env.OTP_MAX_ATTEMPTS, 10) || 3,
  },

  email: {
    from: process.env.EMAIL_FROM || 'noreply@pos-system.com',
    fromName: process.env.EMAIL_FROM_NAME || 'POS System',
    template: {
      subject: process.env.OTP_EMAIL_SUBJECT || 'Your POS PIN Reset OTP',
      body: process.env.OTP_EMAIL_BODY ||
        'Your OTP for PIN reset is: {{OTP}}. It expires in {{EXPIRY}} minutes.',
    },
  },

  ui: {
    primaryColor: process.env.UI_PRIMARY_COLOR || '#16a34a',
    primaryColorHover: process.env.UI_PRIMARY_COLOR_HOVER || '#15803d',
    primaryColorLight: process.env.UI_PRIMARY_COLOR_LIGHT || '#dcfce7',
  },

  roles: {
    MANAGER: 'manager',
    CASHIER: 'cashier',
  },

  permissions: {
    FORGET_PIN: 'forget_pin',
    VOID_ORDERS: 'void_orders',
    VIEW_REPORTS: 'view_reports',
    BATCH_OPEN_CLOSE: 'batch_open_close',
    PLACE_ORDERS: 'place_orders',
    HOLD_ORDERS: 'hold_orders',
    APPLY_DISCOUNT: 'apply_discount',
    SPLIT_PAYMENT: 'split_payment',
  },

  defaultRolePermissions: {
    manager: [
      'forget_pin',
      'void_orders',
      'view_reports',
      'batch_open_close',
      'place_orders',
      'hold_orders',
      'apply_discount',
      'split_payment',
    ],
    cashier: [
      'place_orders',
      'hold_orders',
      'apply_discount',
      'split_payment',
    ],
  },
};

module.exports = authConfig;
