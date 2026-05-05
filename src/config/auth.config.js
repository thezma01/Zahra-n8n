'use strict';

const authConfig = {
  pin: {
    length: parseInt(process.env.PIN_LENGTH, 10) || 5,
    maxAttempts: parseInt(process.env.PIN_MAX_ATTEMPTS, 10) || 5,
    lockoutDurationMinutes: parseInt(process.env.PIN_LOCKOUT_MINUTES, 10) || 15,
  },
  otp: {
    length: parseInt(process.env.OTP_LENGTH, 10) || 6,
    expiryMinutes: parseInt(process.env.OTP_EXPIRY_MINUTES, 10) || 5,
    maxAttempts: parseInt(process.env.OTP_MAX_ATTEMPTS, 10) || 3,
  },
  jwt: {
    secret: process.env.JWT_SECRET || 'pos-jwt-secret-change-in-production',
    expiresIn: process.env.JWT_EXPIRES_IN || '8h',
    refreshExpiresIn: process.env.JWT_REFRESH_EXPIRES_IN || '7d',
  },
  session: {
    autoLogoutMinutes: parseInt(process.env.SESSION_AUTO_LOGOUT_MINUTES, 10) || 30,
  },
  ui: {
    primaryColor: process.env.UI_PRIMARY_COLOR || '#16a34a',
    primaryColorHover: process.env.UI_PRIMARY_COLOR_HOVER || '#15803d',
    logoUrl: process.env.UI_LOGO_URL || '/assets/logo.png',
    appName: process.env.APP_NAME || 'POS System',
  },
  email: {
    from: process.env.EMAIL_FROM || 'noreply@possystem.com',
    fromName: process.env.EMAIL_FROM_NAME || 'POS System',
    otpSubject: process.env.OTP_EMAIL_SUBJECT || 'Your PIN Reset OTP',
    otpTemplate: process.env.OTP_EMAIL_TEMPLATE || 'default',
  },
};

module.exports = authConfig;
