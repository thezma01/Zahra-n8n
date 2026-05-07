const User = require('../models/User');

const getAllUsers = async (req, res) => {
  const users = await User.find();
  res.send(users);
};

const getUserById = async (req, res) => {
  const id = req.params.id;
  const user = await User.findById(id);
  if (!user) {
    return res.status(404).send('User not found');
  }
  res.send(user);
};

const createUser = async (req, res) => {
  const user = new User(req.body);
  await user.save();
  res.send(user);
};

const updateUser = async (req, res) => {
  const id = req.params.id;
  const user = await User.findByIdAndUpdate(id, req.body, { new: true });
  if (!user) {
    return res.status(404).send('User not found');
  }
  res.send(user);
};

const deleteUser = async (req, res) => {
  const id = req.params.id;
  await User.findByIdAndRemove(id);
  res.send('User deleted successfully');
};

module.exports = { getAllUsers, getUserById, createUser, updateUser, deleteUser };
