'use strict';

require('dotenv').config();

const authConfig = {
  jwt: {
    secret: process.env.JWT_SECRET || 'fallback-secret-change-in-production',
    expiresIn: process.env.JWT_EXPIRES_IN || '8h',
    refreshSecret: process.env.JWT_REFRESH_SECRET || 'fallback-refresh-secret',
    refreshExpiresIn: process.env.JWT_REFRESH_EXPIRES_IN || '7d',
    algorithm: 'HS256',
  },

  pin: {
    length: parseInt(process.env.PIN_LENGTH) || 5,
    maxAttempts: parseInt(process.env.PIN_MAX_ATTEMPTS) || 5,
    lockoutMinutes: parseInt(process.env.PIN_LOCKOUT_MINUTES) || 15,
    saltRounds: 12,
  },

  otp: {
    length: parseInt(process.env.OTP_LENGTH) || 6,
    expiryMinutes: parseInt(process.env.OTP_EXPIRY_MINUTES) || 5,
    maxAttempts: parseInt(process.env.OTP_MAX_ATTEMPTS) || 3,
  },

  rateLimit: {
    windowMs: 15 * 60 * 1000, // 15 minutes
    maxRequests: 100,
    loginMaxRequests: 10,
  },

  theme: {
    primaryColor: process.env.PRIMARY_COLOR || '#16a34a',
    primaryHover: process.env.PRIMARY_HOVER || '#15803d',
    logoUrl: process.env.LOGO_URL || '/assets/logo.png',
    appName: process.env.APP_NAME || 'POS System',
  },
};

module.exports = authConfig;
