const express = require('express');
const router = express.Router();
const AuthController = require('../controllers/AuthController');

const authController = new AuthController();

router.post('/login', authController.login);
router.post('/forgot-pin', authController.forgotPin);
router.post('/reset-pin', authController.resetPin);

module.exports = router;
