const mongoose = require('mongoose');

const userSchema = new mongoose.Schema({
  name: String,
  role: String,
  pin: String,
  email: String
});

const User = mongoose.model('User', userSchema);

module.exports = User;
