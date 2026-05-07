const express = require('express');
const router = express.Router();
const authController = new (require('../controllers/AuthController'))();

router.get('/login', (req, res) => {
    res.render('login');
});

router.post('/login', (req, res) => {
    const id = req.body.id;
    const pin = req.body.pin;
    const user = authController.authenticateUser(id, pin);
    if (user) {
        res.redirect('/dashboard');
    } else {
        res.render('login', { error: 'Invalid PIN' });
    }
});

router.get('/forgot-pin', (req, res) => {
    res.render('forgot-pin');
});

router.post('/forgot-pin', (req, res) => {
    const id = req.body.id;
    authController.forgotPin(id);
    res.render('forgot-pin', { message: 'OTP sent to your email' });
});

router.post('/reset-pin', (req, res) => {
    const id = req.body.id;
    const newPin = req.body.newPin;
    authController.resetPin(id, newPin);
    res.render('login');
});

module.exports = router;
