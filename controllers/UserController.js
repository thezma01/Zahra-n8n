const User = require('../models/User');

const getUsers = async (req, res) => {
  const users = await User.find();
  res.send(users);
};

const getUser = async (req, res) => {
  const user = await User.findById(req.params.id);
  res.send(user);
};

const createUser = async (req, res) => {
  const user = new User(req.body);
  await user.save();
  res.send(user);
};

const updateUser = async (req, res) => {
  const user = await User.findByIdAndUpdate(req.params.id, req.body, { new: true });
  res.send(user);
};

const deleteUser = async (req, res) => {
  await User.findByIdAndRemove(req.params.id);
  res.send({ message: 'User deleted successfully' });
};

module.exports = { getUsers, getUser, createUser, updateUser, deleteUser };
