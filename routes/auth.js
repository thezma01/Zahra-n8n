const express = require('express');
const router = express.Router();
const authController = require('../controllers/AuthController');

router.post('/login', authController.login);
router.post('/forgot-pin', authController.forgotPin);

module.exports = router;
