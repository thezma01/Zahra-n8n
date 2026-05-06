'use strict';

const express = require('express');
const router = express.Router();

router.get('/login', (req, res) => {
  res.render('auth/login', { title: 'POS Login' });
});

router.get('/forgot-pin', (req, res) => {
  res.render('auth/forgot-pin', { title: 'Forgot PIN' });
});

router.get('/otp-verification', (req, res) => {
  res.render('auth/otp-verification', { title: 'Verify OTP' });
});

router.get('/reset-pin', (req, res) => {
  res.render('auth/reset-pin', { title: 'Reset PIN' });
});

router.get('/', (req, res) => {
  res.redirect('/login');
});

module.exports = router;
