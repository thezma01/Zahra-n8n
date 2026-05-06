'use strict';

const express = require('express');
const router = express.Router();
const UserController = require('../controllers/UserController');
const { authenticate, requireManager, requirePermission } = require('../middleware/auth.middleware');

// All user routes require authentication
router.use(authenticate);

// List all users (managers only)
router.get('/', requireManager, UserController.list);

// Get single user
router.get('/:id', requireManager, UserController.getById);

// Create user
router.post('/', requireManager, requirePermission('MANAGE_USERS'), UserController.create);

// Update user
router.put('/:id', requireManager, requirePermission('MANAGE_USERS'), UserController.update);

// Reset another user's PIN (manager only)
router.post('/:id/reset-pin', requireManager, requirePermission('RESET_ANY_PIN'), UserController.resetPin);

// Toggle user active status
router.patch('/:id/toggle-active', requireManager, requirePermission('MANAGE_USERS'), UserController.toggleActive);

// Delete user (soft delete)
router.delete('/:id', requireManager, requirePermission('MANAGE_USERS'), UserController.remove);

module.exports = router;
