'use strict';

const jwt = require('jsonwebtoken');
const authConfig = require('../config/auth.config');
const User = require('../models/User');
const PinService = require('../services/PinService');
const OtpService = require('../services/OtpService');
const EmailService = require('../services/EmailService');

class AuthController {
  /**
   * GET /api/auth/config
   * Returns public UI config for the login screen.
   */
  static async getConfig(req, res, next) {
    try {
      res.json({
        success: true,
        data: {
          pinLength: authConfig.pin.length,
          otpLength: authConfig.otp.length,
          otpExpiryMinutes: authConfig.otp.expiryMinutes,
          primaryColor: authConfig.ui.primaryColor,
          primaryColorHover: authConfig.ui.primaryColorHover,
          logoUrl: authConfig.ui.logoUrl,
          appName: authConfig.ui.appName,
          autoLogoutMinutes: authConfig.session.autoLogoutMinutes,
        },
      });
    } catch (err) {
      next(err);
    }
  }

  /**
   * GET /api/auth/users
   * Returns list of active users (name, role, avatar) for login screen.
   */
  static async listUsers(req, res, next) {
    try {
      const users = await User.findAll({
        where: { isActive: true },
        attributes: ['id', 'name', 'role', 'avatarUrl'],
        order: [['name', 'ASC']],
      });

      const data = users.map((u) => ({
        id: u.id,
        name: u.name,
        role: u.role,
        avatarUrl: u.avatarUrl || null,
        initials: u.initials,
      }));

      res.json({ success: true, data });
    } catch (err) {
      next(err);
    }
  }

  /**
   * POST /api/auth/login
   * Body: { userId, pin }
   */
  static async login(req, res, next) {
    try {
      const { userId, pin } = req.body;

      if (!userId || !pin) {
        return res.status(400).json({
          success: false,
          message: 'User and PIN are required.',
        });
      }

      const user = await User.findOne({ where: { id: userId, isActive: true } });
      if (!user) {
        return res.status(401).json({
          success: false,
          message: 'User not found.',
        });
      }

      // Check lockout
      if (PinService.isLocked(user)) {
        const seconds = PinService.lockoutRemainingSeconds(user);
        const minutes = Math.ceil(seconds / 60);
        return res.status(423).json({
          success: false,
          message: `Account locked. Try again in ${minutes} minute(s).`,
          lockedUntil: user.lockedUntil,
        });
      }

      // Validate PIN format
      const formatCheck = PinService.validate(pin);
      if (!formatCheck.valid) {
        return res.status(400).json({ success: false, message: formatCheck.message });
      }

      // Verify PIN
      const pinValid = await user.verifyPin(pin);
      if (!pinValid) {
        const result = await PinService.handleFailedAttempt(user);
        if (result.locked) {
          return res.status(423).json({
            success: false,
            message: `Too many failed attempts. Account locked for ${authConfig.pin.lockoutDurationMinutes} minute(s).`,
          });
        }
        return res.status(401).json({
          success: false,
          message: `Incorrect PIN. ${result.attemptsLeft} attempt(s) remaining.`,
        });
      }

      // Success
      await PinService.resetAttempts(user);

      const accessToken = jwt.sign(
        { userId: user.id, role: user.role },
        authConfig.jwt.secret,
        { expiresIn: authConfig.jwt.expiresIn }
      );

      const refreshToken = jwt.sign(
        { userId: user.id, type: 'refresh' },
        authConfig.jwt.secret,
        { expiresIn: authConfig.jwt.refreshExpiresIn }
      );

      res.json({
        success: true,
        message: 'Login successful.',
        data: {
          accessToken,
          refreshToken,
          expiresIn: authConfig.jwt.expiresIn,
          user: user.toPublicJSON(),
        },
      });
    } catch (err) {
      next(err);
    }
  }

  /**
   * POST /api/auth/forgot-pin/request
   * Body: { userId }
   */
  static async requestForgotPin(req, res, next) {
    try {
      const { userId } = req.body;

      if (!userId) {
        return res.status(400).json({ success: false, message: 'User ID is required.' });
      }

      const user = await User.findOne({ where: { id: userId, isActive: true } });
      if (!user) {
        return res.status(404).json({ success: false, message: 'User not found.' });
      }

      // Only managers can reset PIN via email OTP
      if (user.role !== 'manager') {
        return res.status(403).json({
          success: false,
          message: 'PIN reset via email is only available for manager accounts.',
        });
      }

      const otp = OtpService.generate();
      await OtpService.attachToUser(user, otp);

      await EmailService.sendOtpEmail({
        toEmail: user.email,
        userName: user.name,
        otp,
      });

      // Mask email for display
      const emailParts = user.email.split('@');
      const maskedEmail =
        emailParts[0].substring(0, 2) +
        '***@' +
        emailParts[1];

      res.json({
        success: true,
        message: `OTP sent to ${maskedEmail}. Valid for ${authConfig.otp.expiryMinutes} minute(s).`,
        data: { maskedEmail, expiryMinutes: authConfig.otp.expiryMinutes },
      });
    } catch (err) {
      next(err);
    }
  }

  /**
   * POST /api/auth/forgot-pin/verify
   * Body: { userId, otp }
   */
  static async verifyOtp(req, res, next) {
    try {
      const { userId, otp } = req.body;

      if (!userId || !otp) {
        return res.status(400).json({ success: false, message: 'User ID and OTP are required.' });
      }

      const user = await User.findOne({ where: { id: userId, isActive: true } });
      if (!user) {
        return res.status(404).json({ success: false, message: 'User not found.' });
      }

      const result = await OtpService.validateForUser(user, otp);
      if (!result.valid) {
        return res.status(400).json({ success: false, message: result.message });
      }

      // Issue a short-lived PIN reset token
      const resetToken = jwt.sign(
        { userId: user.id, type: 'pin_reset' },
        authConfig.jwt.secret,
        { expiresIn: '10m' }
      );

      res.json({
        success: true,
        message: 'OTP verified. You may now set a new PIN.',
        data: { resetToken },
      });
    } catch (err) {
      next(err);
    }
  }

  /**
   * POST /api/auth/forgot-pin/reset
   * Body: { resetToken, newPin }
   */
  static async resetPin(req, res, next) {
    try {
      const { resetToken, newPin } = req.body;

      if (!resetToken || !newPin) {
        return res.status(400).json({ success: false, message: 'Reset token and new PIN are required.' });
      }

      let decoded;
      try {
        decoded = jwt.verify(resetToken, authConfig.jwt.secret);
      } catch {
        return res.status(400).json({ success: false, message: 'Invalid or expired reset token.' });
      }

      if (decoded.type !== 'pin_reset') {
        return res.status(400).json({ success: false, message: 'Invalid reset token type.' });
      }

      const pinCheck = PinService.validate(newPin);
      if (!pinCheck.valid) {
        return res.status(400).json({ success: false, message: pinCheck.message });
      }

      const user = await User.findOne({ where: { id: decoded.userId, isActive: true } });
      if (!user) {
        return res.status(404).json({ success: false, message: 'User not found.' });
      }

      user.pinHash = newPin; // beforeUpdate hook will hash it
      await OtpService.clearFromUser(user);
      await user.save();

      res.json({ success: true, message: 'PIN reset successfully. You may now log in.' });
    } catch (err) {
      next(err);
    }
  }

  /**
   * POST /api/auth/logout
   */
  static async logout(req, res, next) {
    try {
      // Stateless JWT — client discards token; log the event
      res.json({ success: true, message: 'Logged out successfully.' });
    } catch (err) {
      next(err);
    }
  }

  /**
   * GET /api/auth/me
   */
  static async me(req, res, next) {
    try {
      res.json({ success: true, data: req.user.toPublicJSON() });
    } catch (err) {
      next(err);
    }
  }

  /**
   * POST /api/auth/refresh
   * Body: { refreshToken }
   */
  static async refresh(req, res, next) {
    try {
      const { refreshToken } = req.body;
      if (!refreshToken) {
        return res.status(400).json({ success: false, message: 'Refresh token required.' });
      }

      let decoded;
      try {
        decoded = jwt.verify(refreshToken, authConfig.jwt.secret);
      } catch {
        return res.status(401).json({ success: false, message: 'Invalid or expired refresh token.' });
      }

      if (decoded.type !== 'refresh') {
        return res.status(401).json({ success: false, message: 'Invalid token type.' });
      }

      const user = await User.findOne({ where: { id: decoded.userId, isActive: true } });
      if (!user) {
        return res.status(401).json({ success: false, message: 'User not found.' });
      }

      const accessToken = jwt.sign(
        { userId: user.id, role: user.role },
        authConfig.jwt.secret,
        { expiresIn: authConfig.jwt.expiresIn }
      );

      res.json({
        success: true,
        data: { accessToken, expiresIn: authConfig.jwt.expiresIn },
      });
    } catch (err) {
      next(err);
    }
  }
}

module.exports = AuthController;
