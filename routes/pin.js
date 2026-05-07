const express = require('express');
const router = express.Router();
const PinController = require('../controllers/PinController');

router.post('/login', PinController.login);
router.post('/forgot-pin', PinController.forgotPin);
router.post('/reset-pin', PinController.resetPin);

module.exports = router;
