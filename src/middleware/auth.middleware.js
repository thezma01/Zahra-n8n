'use strict';

const jwt = require('jsonwebtoken');
const authConfig = require('../config/auth.config');
const User = require('../models/User');
const Role = require('../models/Role');

/**
 * Verify JWT and attach user to req.user.
 */
async function authenticate(req, res, next) {
  try {
    const authHeader = req.headers.authorization || '';
    const token = authHeader.startsWith('Bearer ')
      ? authHeader.slice(7)
      : null;

    if (!token) {
      return res.status(401).json({
        success: false,
        message: 'Authentication required. Please log in.',
      });
    }

    let decoded;
    try {
      decoded = jwt.verify(token, authConfig.jwt.secret);
    } catch (err) {
      const message =
        err.name === 'TokenExpiredError'
          ? 'Session expired. Please log in again.'
          : 'Invalid token. Please log in again.';
      return res.status(401).json({ success: false, message });
    }

    const user = await User.findOne({
      where: { id: decoded.userId, isActive: true },
    });

    if (!user) {
      return res.status(401).json({
        success: false,
        message: 'User not found or deactivated.',
      });
    }

    req.user = user;
    next();
  } catch (err) {
    next(err);
  }
}

/**
 * Check if req.user has a specific permission.
 * @param {string} permissionKey
 */
function requirePermission(permissionKey) {
  return async (req, res, next) => {
    try {
      if (!req.user) {
        return res.status(401).json({ success: false, message: 'Not authenticated.' });
      }

      const role = await Role.findOne({ where: { name: req.user.role } });
      if (!role || !role.hasPermission(permissionKey)) {
        return res.status(403).json({
          success: false,
          message: `Access denied. You do not have the '${permissionKey}' permission.`,
        });
      }

      next();
    } catch (err) {
      next(err);
    }
  };
}

/**
 * Restrict route to manager role only.
 */
function requireManager(req, res, next) {
  if (!req.user || req.user.role !== 'manager') {
    return res.status(403).json({
      success: false,
      message: 'Manager access required.',
    });
  }
  next();
}

module.exports = { authenticate, requirePermission, requireManager };
