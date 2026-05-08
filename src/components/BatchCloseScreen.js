import React, { useState } from 'react';
import axios from 'axios';
import BatchSummaryScreen from './BatchSummaryScreen';

const BatchCloseScreen = () => {
  const [batch, setBatch] = useState({});
  const [closingCashAmount, setClosingCashAmount] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('/api/batch/close', {
        batchId: batch._id,
        closingCashAmount
      });
      setBatch(response.data);
    } catch (error) {
      console.error(error);
    }
  };

  const handleGetBatch = async () => {
    try {
      const response = await axios.get('/api/batch/active');
      setBatch(response.data);
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <div>
      <h1>Close Batch</h1>
      <button onClick={handleGetBatch}>Get Active Batch</button>
      {batch._id && (
        <form onSubmit={handleSubmit}>
          <BatchSummaryScreen batch={batch} />
          <label>
            Closing Cash Amount:
            <input type="number" value={closingCashAmount} onChange={(e) => setClosingCashAmount(e.target.value)} />
          </label>
          <button type="submit">Close Batch</button>
        </form>
      )}
    </div>
  );
};

export default BatchCloseScreen;
