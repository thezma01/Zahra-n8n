'use strict';

const bcrypt = require('bcryptjs');
const authConfig = require('../config/auth.config');

class PinService {
  /**
   * Validate PIN format based on configured length.
   * @param {string|number} pin
   * @returns {{ valid: boolean, message?: string }}
   */
  static validate(pin) {
    const pinStr = String(pin).trim();
    const { length } = authConfig.pin;

    if (!/^\d+$/.test(pinStr)) {
      return { valid: false, message: 'PIN must contain digits only.' };
    }
    if (pinStr.length !== length) {
      return {
        valid: false,
        message: `PIN must be exactly ${length} digits.`,
      };
    }
    return { valid: true };
  }

  /**
   * Hash a plain PIN.
   * @param {string|number} pin
   * @returns {Promise<string>}
   */
  static async hash(pin) {
    return bcrypt.hash(String(pin), 12);
  }

  /**
   * Compare a plain PIN with its hash.
   * @param {string|number} pin
   * @param {string} hash
   * @returns {Promise<boolean>}
   */
  static async verify(pin, hash) {
    return bcrypt.compare(String(pin), hash);
  }

  /**
   * Determine if a user account is currently locked.
   * @param {import('../models/User')} user
   * @returns {boolean}
   */
  static isLocked(user) {
    if (!user.lockedUntil) return false;
    return new Date() < new Date(user.lockedUntil);
  }

  /**
   * Get remaining lockout seconds.
   * @param {import('../models/User')} user
   * @returns {number}
   */
  static lockoutRemainingSeconds(user) {
    if (!user.lockedUntil) return 0;
    const remaining = new Date(user.lockedUntil) - new Date();
    return remaining > 0 ? Math.ceil(remaining / 1000) : 0;
  }

  /**
   * Process a failed PIN attempt — increments counter and locks if needed.
   * @param {import('../models/User')} user
   * @returns {Promise<{ locked: boolean, attemptsLeft: number }>}
   */
  static async handleFailedAttempt(user) {
    const { maxAttempts, lockoutDurationMinutes } = authConfig.pin;
    user.failedPinAttempts = (user.failedPinAttempts || 0) + 1;

    if (user.failedPinAttempts >= maxAttempts) {
      const lockUntil = new Date();
      lockUntil.setMinutes(lockUntil.getMinutes() + lockoutDurationMinutes);
      user.lockedUntil = lockUntil;
      await user.save();
      return { locked: true, attemptsLeft: 0 };
    }

    await user.save();
    return {
      locked: false,
      attemptsLeft: maxAttempts - user.failedPinAttempts,
    };
  }

  /**
   * Reset failed attempts after successful login.
   * @param {import('../models/User')} user
   * @returns {Promise<void>}
   */
  static async resetAttempts(user) {
    user.failedPinAttempts = 0;
    user.lockedUntil = null;
    user.lastLoginAt = new Date();
    await user.save();
  }
}

module.exports = PinService;
