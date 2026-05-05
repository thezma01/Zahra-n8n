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
    const { length } = authConfig.otp;
    const max = Math.pow(10, length);
    const min = Math.pow(10, length - 1);
    const otp = (crypto.randomInt(min, max)).toString();
    return otp;
  }

  /**
   * Hash an OTP for secure storage.
   * @param {string} otp
   * @returns {Promise<string>}
   */
  static async hash(otp) {
    return bcrypt.hash(otp, 10);
  }

  /**
   * Verify a plain OTP against its hash.
   * @param {string} otp
   * @param {string} hash
   * @returns {Promise<boolean>}
   */
  static async verify(otp, hash) {
    return bcrypt.compare(otp, hash);
  }

  /**
   * Compute OTP expiry date from now.
   * @returns {Date}
   */
  static expiryDate() {
    const { expiryMinutes } = authConfig.otp;
    const expiry = new Date();
    expiry.setMinutes(expiry.getMinutes() + expiryMinutes);
    return expiry;
  }

  /**
   * Check if OTP is expired.
   * @param {Date|string} expiresAt
   * @returns {boolean}
   */
  static isExpired(expiresAt) {
    if (!expiresAt) return true;
    return new Date() > new Date(expiresAt);
  }

  /**
   * Store OTP on user record.
   * @param {import('../models/User')} user
   * @param {string} plainOtp
   * @returns {Promise<void>}
   */
  static async attachToUser(user, plainOtp) {
    user.otpHash = await OtpService.hash(plainOtp);
    user.otpExpiresAt = OtpService.expiryDate();
    user.otpAttempts = 0;
    await user.save();
  }

  /**
   * Clear OTP fields after successful use or expiry.
   * @param {import('../models/User')} user
   * @returns {Promise<void>}
   */
  static async clearFromUser(user) {
    user.otpHash = null;
    user.otpExpiresAt = null;
    user.otpAttempts = 0;
    await user.save();
  }

  /**
   * Validate OTP for a user — handles expiry and attempt limits.
   * @param {import('../models/User')} user
   * @param {string} plainOtp
   * @returns {Promise<{ valid: boolean, message: string }>}
   */
  static async validateForUser(user, plainOtp) {
    const { maxAttempts } = authConfig.otp;

    if (!user.otpHash) {
      return { valid: false, message: 'No OTP request found. Please request a new OTP.' };
    }
    if (OtpService.isExpired(user.otpExpiresAt)) {
      await OtpService.clearFromUser(user);
      return { valid: false, message: 'OTP has expired. Please request a new one.' };
    }
    if (user.otpAttempts >= maxAttempts) {
      await OtpService.clearFromUser(user);
      return { valid: false, message: 'Too many OTP attempts. Please request a new OTP.' };
    }

    const match = await OtpService.verify(plainOtp, user.otpHash);
    if (!match) {
      user.otpAttempts = (user.otpAttempts || 0) + 1;
      await user.save();
      const remaining = maxAttempts - user.otpAttempts;
      return {
        valid: false,
        message: `Incorrect OTP. ${remaining} attempt(s) remaining.`,
      };
    }

    return { valid: true, message: 'OTP verified.' };
  }
}

module.exports = OtpService;
