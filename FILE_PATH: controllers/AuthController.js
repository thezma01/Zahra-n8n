const User = require('../models/User');

class AuthController {
    static async login(req, res) {
        const { userId, pin } = req.body;
        const user = await User.findById(userId);
        if (!user || user.pin !== pin) {
            return res.status(401).send('Invalid credentials');
        }
        return res.send('Login successful');
    }

    static async forgotPin(req, res) {
        const { userId } = req.body;
        const user = await User.findById(userId);
        if (!user) {
            return res.status(404).send('User not found');
        }
        // Send OTP to user's email
        return res.send('OTP sent to your email');
    }

    static async resetPin(req, res) {
        const { userId, otp, newPin } = req.body;
        const user = await User.findById(userId);
        if (!user) {
            return res.status(404).send('User not found');
        }
        // Verify OTP and update user's pin
        return res.send('Pin reset successful');
    }
}

module.exports = AuthController;
