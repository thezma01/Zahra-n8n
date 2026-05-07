const User = require('../models/User');
const authUtils = require('../utils/authUtils');

exports.login = async (req, res) => {
  try {
    const user = await User.findOne({ name: req.body.name });
    if (!user) {
      return res.status(401).send({ message: 'Invalid user' });
    }
    const isValidPin = await authUtils.validatePin(user.pin, req.body.pin);
    if (!isValidPin) {
      return res.status(401).send({ message: 'Invalid PIN' });
    }
    res.send({ message: 'Login successful' });
  } catch (error) {
    res.status(500).send({ message: 'Internal server error' });
  }
};

exports.forgotPin = async (req, res) => {
  try {
    const user = await User.findOne({ email: req.body.email });
    if (!user) {
      return res.status(401).send({ message: 'Invalid email' });
    }
    const otp = await authUtils.generateOtp();
    await authUtils.sendOtpEmail(user.email, otp);
    res.send({ message: 'OTP sent to your email' });
  } catch (error) {
    res.status(500).send({ message: 'Internal server error' });
  }
};
