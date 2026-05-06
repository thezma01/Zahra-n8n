import dotenv from 'dotenv';

dotenv.config();

export interface AuthConfig {
  jwt: {
    secret: string;
    expiresIn: string;
    refreshSecret: string;
    refreshExpiresIn: string;
  };
  pin: {
    length: number;
    maxAttempts: number;
    lockoutDurationMinutes: number;
  };
  otp: {
    length: number;
    expiryMinutes: number;
  };
  email: {
    otpSubject: string;
    otpTemplate: string;
  };
  app: {
    name: string;
    url: string;
    primaryColor: string;
  };
}

export const authConfig: AuthConfig = {
  jwt: {
    secret: process.env.JWT_SECRET || 'fallback_secret_change_in_production',
    expiresIn: process.env.JWT_EXPIRES_IN || '8h',
    refreshSecret:
      process.env.JWT_REFRESH_SECRET ||
      'fallback_refresh_secret_change_in_production',
    refreshExpiresIn: process.env.JWT_REFRESH_EXPIRES_IN || '7d',
  },
  pin: {
    length: parseInt(process.env.PIN_LENGTH || '5', 10),
    maxAttempts: parseInt(process.env.PIN_MAX_ATTEMPTS || '5', 10),
    lockoutDurationMinutes: parseInt(
      process.env.PIN_LOCKOUT_DURATION_MINUTES || '15',
      10
    ),
  },
  otp: {
    length: parseInt(process.env.OTP_LENGTH || '6', 10),
    expiryMinutes: parseInt(process.env.OTP_EXPIRY_MINUTES || '5', 10),
  },
  email: {
    otpSubject:
      process.env.EMAIL_OTP_SUBJECT || 'Your PIN Reset OTP - POS System',
    otpTemplate: process.env.EMAIL_OTP_TEMPLATE || 'default',
  },
  app: {
    name: process.env.APP_NAME || 'POS System',
    url: process.env.APP_URL || 'http://localhost:3000',
    primaryColor: process.env.PRIMARY_COLOR || '#16a34a',
  },
};

export default authConfig;
