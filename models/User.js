const mongoose = require('mongoose');
const bcrypt = require('bcrypt');

const userSchema = new mongoose.Schema({
  name: String,
  email: String,
  pin: String,
  role: String
});

userSchema.pre('save', function(next) {
  const user = this;
  bcrypt.hash(user.pin, 10, function(err, hash) {
    if (err) {
      return next(err);
    }
    user.pin = hash;
    next();
  });
});

const User = mongoose.model('User', userSchema);

module.exports = User;
