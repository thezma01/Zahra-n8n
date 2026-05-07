const jwt = require('jsonwebtoken');

const secretKey = 'your-secret-key';

const generateToken = (user) => {
  const token = jwt.sign({ userId: user._id }, secretKey, { expiresIn: '1h' });
  return token;
};

module.exports = generateToken;
