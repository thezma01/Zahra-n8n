const mongoose = require('mongoose');
const bcrypt = require('bcrypt');

const userSchema = new mongoose.Schema({
  name: {
    type: String,
    required: true
  },
  email: {
    type: String,
    required: true,
    unique: true
  },
  role: {
    type: String,
    enum: ['Manager', 'Cashier'],
    required: true
  },
  pin: {
    type: String,
    required: true
  }
});

userSchema.pre('save', async function(next) {
  if (this.isNew || this.isModified('pin')) {
    const salt = await bcrypt.genSalt(10);
    this.pin = await bcrypt.hash(this.pin, salt);
  }
  next();
});

const User = mongoose.model('User', userSchema);

module.exports = User;
