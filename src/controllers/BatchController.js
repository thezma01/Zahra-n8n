const Batch = require('../models/Batch');
const batchUtils = require('../utils/batchUtils');

class BatchController {
  async openBatch(req, res) {
    const { openingCashAmount } = req.body;
    const batch = new Batch({ openingCashAmount });
    await batch.save();
    res.send(`Batch ${batch.batchNumber} opened successfully`);
  }

  async closeBatch(req, res) {
    const { batchId, closingCashAmount } = req.body;
    const batch = await Batch.findById(batchId);
    batch.closingCashAmount = closingCashAmount;
    batch.isActive = false;
    await batch.save();
    res.send(`Batch ${batch.batchNumber} closed successfully`);
  }

  async getActiveBatch(req, res) {
    const batch = await Batch.findOne({ isActive: true });
    if (!batch) {
      res.send('No active batch');
    } else {
      res.send(batch);
    }
  }
}

module.exports = new BatchController();
