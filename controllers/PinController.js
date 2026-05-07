const User = require('../models/User');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const config = require('../config');

const login = async (req, res) => {
  const { userId, pin } = req.body;
  const user = await User.findOne({ _id: userId });
  if (!user) {
    return res.status(401).send('Invalid user or pin');
  }
  const isValidPin = await bcrypt.compare(pin, user.pin);
  if (!isValidPin) {
    return res.status(401).send('Invalid user or pin');
  }
  const token = jwt.sign({ userId: user._id }, config.secret, { expiresIn: '1h' });
  res.send({ token, user });
};

const forgotPin = async (req, res) => {
  const { email } = req.body;
  const user = await User.findOne({ email });
  if (!user) {
    return res.status(404).send('User not found');
  }
  const otp = Math.floor(100000 + Math.random() * 900000);
  // send otp to user's email
  res.send({ otp });
};

const resetPin = async (req, res) => {
  const { email, otp, newPin } = req.body;
  const user = await User.findOne({ email });
  if (!user) {
    return res.status(404).send('User not found');
  }
  // verify otp
  user.pin = newPin;
  await user.save();
  res.send('Pin reset successfully');
};

module.exports = { login, forgotPin, resetPin };
