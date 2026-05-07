const mongoose = require('mongoose');
const bcrypt = require('bcrypt');

const userSchema = new mongoose.Schema({
  name: { type: String, required: true },
  email: { type: String, required: true, unique: true },
  pin: { type: String, required: true },
  role: { type: String, enum: ['Manager', 'Cashier'], required: true },
});

userSchema.pre('save', async function(next) {
  if (this.isNew || this.isModified('pin')) {
    this.pin = await bcrypt.hash(this.pin, 10);
  }
  next();
});

const User = mongoose.model('User', userSchema);

module.exports = User;
