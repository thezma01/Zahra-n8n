const jwt = require('jsonwebtoken');
const config = require('../config');
const User = require('../models/User');

const login = async (req, res) => {
  const { userId, pin } = req.body;
  const user = await User.findById(userId);
  if (!user || !(await user.comparePin(pin))) {
    return res.status(401).send({ message: 'Incorrect PIN, please try again' });
  }
  const token = jwt.sign({ userId: user._id }, config.secretKey, { expiresIn: '1h' });
  res.send({ token });
};

const forgotPin = async (req, res) => {
  const { email } = req.body;
  const user = await User.findOne({ email });
  if (!user) {
    return res.status(404).send({ message: 'User not found' });
  }
  // Send OTP to user's email
  res.send({ message: 'OTP sent to your email' });
};

const resetPin = async (req, res) => {
  const { userId, otp, newPin } = req.body;
  const user = await User.findById(userId);
  if (!user) {
    return res.status(404).send({ message: 'User not found' });
  }
  // Verify OTP and update user's PIN
  res.send({ message: 'PIN reset successfully' });
};

module.exports = { login, forgotPin, resetPin };
