const User = require('../models/User');
const sendEmail = require('../utils/sendEmail');
const generateOTP = require('../utils/generateOTP');

class AuthController {
  async login(req, res) {
    try {
      const user = await User.findOne({ email: req.body.email });
      if (!user) {
        return res.status(401).json({ message: 'Invalid email or password' });
      }
      // Compare passwords and return token or error
    } catch (error) {
      return res.status(500).json({ message: 'Internal server error' });
    }
  }

  async forgetPIN(req, res) {
    try {
      const user = await User.findOne({ email: req.body.email });
      if (!user) {
        return res.status(401).json({ message: 'Invalid email' });
      }
      const otp = generateOTP();
      // Send OTP via email using sendEmail function
      // Update user OTP in database
      return res.json({ message: 'OTP sent successfully' });
    } catch (error) {
      return res.status(500).json({ message: 'Internal server error' });
    }
  }
}

module.exports = AuthController;
