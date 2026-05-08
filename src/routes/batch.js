const express = require('express');
const router = express.Router();
const BatchController = require('../controllers/BatchController');

const batchController = new BatchController();

router.post('/open', batchController.openBatch);
router.post('/close', batchController.closeBatch);
router.get('/active', batchController.getActiveBatch);

module.exports = router;
