'use strict';

const crypto = require('crypto');
const bcrypt = require('bcryptjs');
const authConfig = require('../config/auth.config');

class OtpService {
  /**
   * Generate a numeric OTP of configured length.
   * @returns {string}
   */
  static generate() {
    const length = authConfig.otp.length;
    const max = Math.pow(10, length);
    const min = Math.pow(10, length - 1);
    // Use crypto for secure randomness
    const range = max - min;
    const randomBytes = crypto.randomBytes(4);
    const randomInt = randomBytes.readUInt32BE(0);
    const otp = min + (randomInt % range);
    return String(otp).padStart(length, '0');
  }

  /**
   * Hash and attach OTP + expiry to a user record.
   * @param {import('../models/User')} user
   * @param {string} plainOtp
   * @returns {Promise<void>}
   */
  static async attachToUser(user, plainOtp) {
    const hash = await bcrypt.hash(String(plainOtp), 10);
    const expiryMs = authConfig.otp.expiryMinutes * 60 * 1000;

    user.otpHash = hash;
    user.otpExpiresAt = new Date(Date.now() + expiryMs);
    user.otpAttempts = 0;
    await user.save();
  }

  /**
   * Validate an OTP for a user.
   * @param {import('../models/User')} user
   * @param {string} plainOtp
   * @returns {Promise<{ valid: boolean, message: string }>}
   */
  static async validateForUser(user, plainOtp) {
    if (!user.otpHash || !user.otpExpiresAt) {
      return { valid: false, message: 'No OTP has been requested. Please request a new one.' };
    }

    if (new Date() > new Date(user.otpExpiresAt)) {
      await OtpService.clearFromUser(user);
      return { valid: false, message: 'OTP has expired. Please request a new one.' };
    }

    const maxAttempts = authConfig.otp.maxAttempts;
    if (user.otpAttempts >= maxAttempts) {
      await OtpService.clearFromUser(user);
      return {
        valid: false,
        message: `Too many incorrect attempts. Please request a new OTP.`,
      };
    }

    const isMatch = await bcrypt.compare(String(plainOtp), user.otpHash);

    if (!isMatch) {
      user.otpAttempts = (user.otpAttempts || 0) + 1;
      await user.save();
      const attemptsLeft = maxAttempts - user.otpAttempts;
      return {
        valid: false,
        message: `Incorrect OTP. ${attemptsLeft} attempt(s) remaining.`,
      };
    }

    // Valid OTP — clear attempts counter but keep hash until PIN is reset
    user.otpAttempts = 0;
    await user.save();

    return { valid: true, message: 'OTP verified successfully.' };
  }

  /**
   * Clear OTP fields from user (after successful reset or expiry).
   * @param {import('../models/User')} user
   * @returns {Promise<void>}
   */
  static async clearFromUser(user) {
    user.otpHash = null;
    user.otpExpiresAt = null;
    user.otpAttempts = 0;
    await user.save();
  }
}

module.exports = OtpService;
