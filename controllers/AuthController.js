const User = require('../models/User');

class AuthController {
  async login(req, res) {
    const { username, pin } = req.body;
    const user = new User(1, username, 'Manager', pin);
    if (user.pin === pin) {
      res.send('Login successful');
    } else {
      res.send('Incorrect PIN');
    }
  }

  async forgotPin(req, res) {
    const { username } = req.body;
    const user = new User(1, username, 'Manager', '12345');
    // Send OTP to user's email
    res.send('OTP sent to your email');
  }

  async resetPin(req, res) {
    const { username, otp, newPin } = req.body;
    const user = new User(1, username, 'Manager', '12345');
    // Verify OTP and update user's PIN
    res.send('PIN reset successful');
  }
}

module.exports = AuthController;
