const User = require('../models/user');

exports.login = async (req, res) => {
    try {
        const user = await User.findOne({ name: req.body.name });
        if (!user) {
            return res.status(401).send({ message: 'Invalid username or password' });
        }
        if (user.pin !== req.body.pin) {
            return res.status(401).send({ message: 'Invalid username or password' });
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
            return res.status(404).send({ message: 'User not found' });
        }
        // Send OTP to user's email
        res.send({ message: 'OTP sent to your email' });
    } catch (error) {
        res.status(500).send({ message: 'Internal server error' });
    }
};
