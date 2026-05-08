const mongoose = require('mongoose');

const batchSchema = new mongoose.Schema({
  batchNumber: {
    type: String,
    unique: true,
    required: true
  },
  openingCashAmount: {
    type: Number,
    required: true
  },
  closingCashAmount: {
    type: Number
  },
  openingDate: {
    type: Date,
    default: Date.now
  },
  closingDate: {
    type: Date
  },
  isActive: {
    type: Boolean,
    default: true
  }
});

const Batch = mongoose.model('Batch', batchSchema);

module.exports = Batch;
