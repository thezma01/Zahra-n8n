'use strict';

const express = require('express');
const router = express.Router();
const AuthController = require('../controllers/AuthController');
const { authenticate } = require('../middleware/auth.middleware');

// Public routes
router.get('/config', AuthController.getConfig);
router.get('/users', AuthController.listUsers);
router.post('/login', AuthController.login);
router.post('/forgot-pin/request', AuthController.requestForgotPin);
router.post('/forgot-pin/verify', AuthController.verifyOtp);
router.post('/forgot-pin/reset', AuthController.resetPin);

// Protected routes
router.post('/logout', authenticate, AuthController.logout);
router.get('/me', authenticate, AuthController.me);
router.post('/refresh', AuthController.refresh);

module.exports = router;
