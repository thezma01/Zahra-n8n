const User = require('../models/User');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');

const login = async (req, res) => {
  const { name, pin } = req.body;
  const user = await User.findOne({ name });
  if (!user) {
    return res.status(401).send({ message: 'Invalid credentials' });
  }
  const isValidPin = await bcrypt.compare(pin, user.pin);
  if (!isValidPin) {
    return res.status(401).send({ message: 'Invalid credentials' });
  }
  const token = jwt.sign({ userId: user._id }, 'secretkey', { expiresIn: '1h' });
  res.send({ token });
};

module.exports = { login };
