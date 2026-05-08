const User = require('../models/User');
const PINService = require('../services/PINService');
const EmailService = require('../services/EmailService');

class AuthController {
  async login(req, res) {
    const { username, pin } = req.body;
    const user = await User.findOne({ name: username });
    if (!user) {
      return res.status(401).send('Invalid username or pin');
    }
    const isValidPin = await PINService.validatePin(user.pin, pin);
    if (!isValidPin) {
      return res.status(401).send('Invalid username or pin');
    }
    res.send('Login successful');
  }

  async forgotPin(req, res) {
    const { email } = req.body;
    const user = await User.findOne({ email });
    if (!user) {
      return res.status(404).send('User not found');
    }
    const otp = await PINService.generateOtp();
    await EmailService.sendOtp(email, otp);
    res.send('Otp sent to your email');
  }

  async resetPin(req, res) {
    const { email, otp, newPin } = req.body;
    const user = await User.findOne({ email });
    if (!user) {
      return res.status(404).send('User not found');
    }
    const isValidOtp = await PINService.validateOtp(otp);
    if (!isValidOtp) {
      return res.status(401).send('Invalid otp');
    }
    user.pin = newPin;
    await user.save();
    res.send('Pin reset successful');
  }
}

module.exports = AuthController;
