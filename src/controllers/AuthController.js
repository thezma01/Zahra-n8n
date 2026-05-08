const authUtils = require('../utils/authUtils');

class AuthController {
  login(req, res) {
    const { username, pin } = req.body;
    // TO DO: implement login logic
    res.send('Login successful');
  }

  forgotPin(req, res) {
    const { email } = req.body;
    // TO DO: implement forgot pin logic
    res.send('OTP sent to your email');
  }

  resetPin(req, res) {
    const { otp, newPin } = req.body;
    // TO DO: implement reset pin logic
    res.send('PIN reset successful');
  }
}

module.exports = new AuthController();
