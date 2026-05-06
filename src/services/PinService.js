'use strict';

const authConfig = require('../config/auth.config');

class PinService {
  /**
   * Validate PIN format against configured length.
   * @param {string|number} pin
   * @returns {{ valid: boolean, message: string }}
   */
  static validate(pin) {
    const pinStr = String(pin).trim();
    const expectedLength = authConfig.pin.length;

    if (!pinStr) {
      return { valid: false, message: 'PIN is required.' };
    }

    if (!/^\d+$/.test(pinStr)) {
      return { valid: false, message: 'PIN must contain digits only.' };
    }

    if (pinStr.length !== expectedLength) {
      return {
        valid: false,
        message: `PIN must be exactly ${expectedLength} digit(s).`,
      };
    }

    return { valid: true, message: 'PIN is valid.' };
  }

  /**
   * Check if a user account is currently locked.
   * @param {import('../models/User')} user
   * @returns {boolean}
   */
  static isLocked(user) {
    if (!user.lockedUntil) return false;
    return new Date(user.lockedUntil) > new Date();
  }

  /**
   * Returns remaining lockout seconds (0 if not locked).
   * @param {import('../models/User')} user
   * @returns {number}
   */
  static lockoutRemainingSeconds(user) {
    if (!user.lockedUntil) return 0;
    const remaining = new Date(user.lockedUntil) - new Date();
    return remaining > 0 ? Math.ceil(remaining / 1000) : 0;
  }

  /**
   * Handle a failed PIN attempt — increment counter, lock if threshold reached.
   * @param {import('../models/User')} user
   * @returns {Promise<{ locked: boolean, attemptsLeft: number }>}
   */
  static async handleFailedAttempt(user) {
    user.failedPinAttempts = (user.failedPinAttempts || 0) + 1;

    const maxAttempts = authConfig.pin.maxAttempts;

    if (user.failedPinAttempts >= maxAttempts) {
      const lockoutMs = authConfig.pin.lockoutDurationMinutes * 60 * 1000;
      user.lockedUntil = new Date(Date.now() + lockoutMs);
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
   * Reset failed attempt counter and clear lockout after successful login.
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
