const User = require('../models/User');

exports.getAllUsers = async (req, res) => {
  try {
    const users = await User.find();
    res.send(users);
  } catch (error) {
    res.status(500).send({ message: 'Internal server error' });
  }
};

exports.getUserById = async (req, res) => {
  try {
    const user = await User.findById(req.params.id);
    if (!user) {
      return res.status(401).send({ message: 'Invalid user' });
    }
    res.send(user);
  } catch (error) {
    res.status(500).send({ message: 'Internal server error' });
  }
};
