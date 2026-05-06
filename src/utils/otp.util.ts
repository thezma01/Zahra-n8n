import crypto from 'crypto';
import { authConfig } from '../config/auth.config';

export interface GeneratedOtp {
  code: string;
  hashedCode: string;
  expiresAt: Date;
}

/**
 * Generate a cryptographically secure OTP of configurable length.
 * The OTP is numeric only.
 */
export const generateOtp = (
  length: number = authConfig.otp.length,
  expiryMinutes: number = authConfig.otp.expiryMinutes
): GeneratedOtp => {
  if (length < 4 || length > 12) {
    throw new Error('OTP length must be between 4 and 12 digits');
  }

  // Generate a numeric OTP using crypto for security
  const max = Math.pow(10, length);
  const randomBytes = crypto.randomBytes(4);
  const randomNumber = randomBytes.readUInt32BE(0);
  const otpNumber = randomNumber % max;
  const code = String(otpNumber).padStart(length, '0');

  // Hash the OTP before storing
  const hashedCode = crypto
    .createHash('sha256')
    .update(code)
    .digest('hex');

  const expiresAt = new Date();
  expiresAt.setMinutes(expiresAt.getMinutes() + expiryMinutes);

  return { code, hashedCode, expiresAt };
};

/**
 * Verify an OTP code against the stored hashed code.
 */
export const verifyOtp = (
  candidateCode: string,
  storedHashedCode: string,
  expiresAt: Date,
  isUsed: boolean
): { valid: boolean; reason?: string } => {
  if (isUsed) {
    return { valid: false, reason: 'OTP has already been used' };
  }

  if (new Date() > expiresAt) {
    return { valid: false, reason: 'OTP has expired' };
  }

  const candidateHash = crypto
    .createHash('sha256')
    .update(candidateCode.trim())
    .digest('hex');

  const isValid = crypto.timingSafeEqual(
    Buffer.from(candidateHash, 'hex'),
    Buffer.from(storedHashedCode, 'hex')
  );

  if (!isValid) {
    return { valid: false, reason: 'Invalid OTP code' };
  }

  return { valid: true };
};

/**
 * Format OTP expiry time for display (e.g., "5 minutes").
 */
export const formatExpiryDuration = (minutes: number): string => {
  if (minutes < 60) return `${minutes} minute${minutes !== 1 ? 's' : ''}`;
  const hours = Math.floor(minutes / 60);
  return `${hours} hour${hours !== 1 ? 's' : ''}`;
};

export default { generateOtp, verifyOtp, formatExpiryDuration };
