'use strict';

const crypto = require('crypto');
const authConfig = require('../config/auth.config');
const EmailService = require('./EmailService');
const User = require('../models/User');
const logger = require('../utils/logger');

class OTPService {
  generateOTP(length) {
    const otpLength = length || authConfig.otp.length;
    const min = Math.pow(10, otpLength - 1);
    const max = Math.pow(10, otpLength) - 1;
    const range = max - min + 1;
    const bytesNeeded = Math.ceil(Math.log2(range) / 8) + 1;
    let otp;
    do {
      const randomBytes = crypto.randomBytes(bytesNeeded);
      const randomValue = parseInt(randomBytes.toString('hex'), 16);
      otp = min + (randomValue % range);
    } while (otp > max);
    return String(otp).padStart(otpLength, '0');
  }

  async sendOTPForPinReset(email) {
    const user = await User.findOne({ email: email.toLowerCase(), isActive: true });

    if (!user) {
      logger.warn(`OTP requested for non-existent or inactive email: ${email}`);
      return {
        success: true,
        message: 'If this email is registered, an OTP has been sent.',
      };
    }

    if (user.role !== authConfig.roles.MANAGER) {
      throw Object.assign(new Error('PIN reset via OTP is only available for managers.'), {
        statusCode: 403,
      });
    }

    const otp = this.generateOTP();
    await user.setOTP(otp);

    await EmailService.sendOTPEmail(user.email, user.name, otp);

    logger.info(`OTP sent for PIN reset`, { userId: user._id, email: user.email });

    return {
      success: true,
      message: 'If this email is registered, an OTP has been sent.',
      userId: user._id,
      expiryMinutes: authConfig.otp.expiryMinutes,
    };
  }

  async verifyOTPAndResetPin(userId, otpCode, newPin) {
    const pinLength = authConfig.pin.length;

    if (!newPin || String(newPin).length !== pinLength || !/^\d+$/.test(String(newPin))) {
      throw Object.assign(
        new Error(`PIN must be exactly ${pinLength} digits.`),
        { statusCode: 400 }
      );
    }

    const user = await User.findById(userId).select('+otp');
    if (!user || !user.isActive) {
      throw Object.assign(new Error('User not found.'), { statusCode: 404 });
    }

    const verification = await user.verifyOTP(String(otpCode));
    if (!verification.valid) {
      throw Object.assign(new Error(verification.reason), { statusCode: 400 });
    }

    user.pin = String(newPin);
    user.failedPinAttempts = 0;
    user.lockedUntil = null;
    await user.save();

    logger.info(`PIN successfully reset via OTP`, { userId: user._id });

    return {
      success: true,
      message: 'PIN has been reset successfully.',
    };
  }
}

module.exports = new OTPService();
