const User = require('../models/User');

const getUsers = async (req, res) => {
  const users = await User.find();
  res.send(users);
};

const getUser = async (req, res) => {
  const userId = req.params.userId;
  const user = await User.findById(userId);
  if (!user) {
    return res.status(404).send({ message: 'User not found' });
  }
  res.send(user);
};

const createUser = async (req, res) => {
  const { name, email, pin, role } = req.body;
  const user = new User({ name, email, pin, role });
  await user.save();
  res.send(user);
};

const updateUser = async (req, res) => {
  const userId = req.params.userId;
  const user = await User.findById(userId);
  if (!user) {
    return res.status(404).send({ message: 'User not found' });
  }
  // Update user's details
  res.send(user);
};

const deleteUser = async (req, res) => {
  const userId = req.params.userId;
  await User.findByIdAndDelete(userId);
  res.send({ message: 'User deleted successfully' });
};

module.exports = { getUsers, getUser, createUser, updateUser, deleteUser };
