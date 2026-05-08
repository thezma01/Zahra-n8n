const moment = require('moment');

const generateBatchNumber = () => {
  const batchNumber = `BH-${moment().format('YYYYMMDDHHmmss')}`;
  return batchNumber;
};

module.exports = {
  generateBatchNumber
};
