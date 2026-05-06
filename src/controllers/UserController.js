'use strict';

const User = require('../models/User');
const PinService = require('../services/PinService');
const { Op } = require('sequelize');

class UserController {
  /**
   * GET /api/users
   */
  static async list(req, res, next) {
    try {
      const { role, search, page = 1, limit = 20 } = req.query;
      const where = {};

      if (role) where.role = role;
      if (search) {
        where[Op.or] = [
          { name: { [Op.iLike]: `%${search}%` } },
          { email: { [Op.iLike]: `%${search}%` } },
        ];
      }

      const offset = (parseInt(page) - 1) * parseInt(limit);
      const { count, rows } = await User.findAndCountAll({
        where,
        attributes: ['id', 'name', 'email', 'role', 'avatarUrl', 'isActive', 'lastLoginAt', 'createdAt'],
        order: [['name', 'ASC']],
        limit: parseInt(limit),
        offset,
      });

      res.json({
        success: true,
        data: {
          users: rows.map((u) => ({ ...u.toPublicJSON(), email: u.email })),
          total: count,
          page: parseInt(page),
          totalPages: Math.ceil(count / parseInt(limit)),
        },
      });
    } catch (err) {
      next(err);
    }
  }

  /**
   * GET /api/users/:id
   */
  static async getById(req, res, next) {
    try {
      const user = await User.findByPk(req.params.id);
      if (!user) {
        return res.status(404).json({ success: false, message: 'User not found.' });
      }
      res.json({ success: true, data: { ...user.toPublicJSON(), email: user.email } });
    } catch (err) {
      next(err);
    }
  }

  /**
   * POST /api/users
   * Body: { name, email, pin, role }
   */
  static async create(req, res, next) {
    try {
      const { name, email, pin, role, avatarUrl } = req.body;

      if (!name || !email || !pin || !role) {
        return res.status(400).json({ success: false, message: 'Name, email, PIN, and role are required.' });
      }

      const pinCheck = PinService.validate(pin);
      if (!pinCheck.valid) {
        return res.status(400).json({ success: false, message: pinCheck.message });
      }

      if (!['manager', 'cashier'].includes(role)) {
        return res.status(400).json({ success: false, message: 'Role must be manager or cashier.' });
      }

      const existing = await User.findOne({ where: { email } });
      if (existing) {
        return res.status(409).json({ success: false, message: 'A user with this email already exists.' });
      }

      const user = await User.create({
        name,
        email,
        pinHash: pin, // beforeCreate hook hashes it
        role,
        avatarUrl: avatarUrl || null,
      });

      res.status(201).json({
        success: true,
        message: 'User created successfully.',
        data: { ...user.toPublicJSON(), email: user.email },
      });
    } catch (err) {
      next(err);
    }
  }

  /**
   * PUT /api/users/:id
   * Body: { name, email, role, avatarUrl, isActive }
   */
  static async update(req, res, next) {
    try {
      const user = await User.findByPk(req.params.id);
      if (!user) {
        return res.status(404).json({ success: false, message: 'User not found.' });
      }

      const { name, email, role, avatarUrl, isActive } = req.body;

      // Prevent self-demotion for last manager
      if (role && role !== user.role && user.role === 'manager') {
        const managerCount = await User.count({ where: { role: 'manager', isActive: true } });
        if (managerCount <= 1) {
          return res.status(400).json({
            success: false,
            message: 'Cannot change role. At least one active manager is required.',
          });
        }
      }

      if (email && email !== user.email) {
        const existing = await User.findOne({ where: { email } });
        if (existing) {
          return res.status(409).json({ success: false, message: 'Email already in use.' });
        }
      }

      if (name !== undefined) user.name = name;
      if (email !== undefined) user.email = email;
      if (role !== undefined) user.role = role;
      if (avatarUrl !== undefined) user.avatarUrl = avatarUrl;
      if (isActive !== undefined) user.isActive = isActive;

      await user.save();

      res.json({
        success: true,
        message: 'User updated successfully.',
        data: { ...user.toPublicJSON(), email: user.email },
      });
    } catch (err) {
      next(err);
    }
  }

  /**
   * POST /api/users/:id/reset-pin
   * Body: { newPin }
   */
  static async resetPin(req, res, next) {
    try {
      const user = await User.findByPk(req.params.id);
      if (!user) {
        return res.status(404).json({ success: false, message: 'User not found.' });
      }

      const { newPin } = req.body;
      if (!newPin) {
        return res.status(400).json({ success: false, message: 'New PIN is required.' });
      }

      const pinCheck = PinService.validate(newPin);
      if (!pinCheck.valid) {
        return res.status(400).json({ success: false, message: pinCheck.message });
      }

      user.pinHash = newPin; // beforeUpdate hook will hash it
      user.failedPinAttempts = 0;
      user.lockedUntil = null;
      await user.save();

      res.json({ success: true, message: 'PIN reset successfully.' });
    } catch (err) {
      next(err);
    }
  }

  /**
   * PATCH /api/users/:id/toggle-active
   */
  static async toggleActive(req, res, next) {
    try {
      const user = await User.findByPk(req.params.id);
      if (!user) {
        return res.status(404).json({ success: false, message: 'User not found.' });
      }

      // Prevent deactivating last active manager
      if (user.role === 'manager' && user.isActive) {
        const managerCount = await User.count({ where: { role: 'manager', isActive: true } });
        if (managerCount <= 1) {
          return res.status(400).json({
            success: false,
            message: 'Cannot deactivate the last active manager.',
          });
        }
      }

      user.isActive = !user.isActive;
      await user.save();

      res.json({
        success: true,
        message: `User ${user.isActive ? 'activated' : 'deactivated'} successfully.`,
        data: user.toPublicJSON(),
      });
    } catch (err) {
      next(err);
    }
  }

  /**
   * DELETE /api/users/:id
   */
  static async remove(req, res, next) {
    try {
      const user = await User.findByPk(req.params.id);
      if (!user) {
        return res.status(404).json({ success: false, message: 'User not found.' });
      }

      // Prevent deleting self
      if (req.user && req.user.id === user.id) {
        return res.status(400).json({ success: false, message: 'You cannot delete your own account.' });
      }

      // Prevent deleting last manager
      if (user.role === 'manager') {
        const managerCount = await User.count({ where: { role: 'manager', isActive: true } });
        if (managerCount <= 1) {
          return res.status(400).json({
            success: false,
            message: 'Cannot delete the last active manager.',
          });
        }
      }

      await user.destroy(); // soft delete via paranoid

      res.json({ success: true, message: 'User deleted successfully.' });
    } catch (err) {
      next(err);
    }
  }
}

module.exports = UserController;
