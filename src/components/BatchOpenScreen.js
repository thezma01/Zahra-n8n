import React, { useState } from 'react';
import axios from 'axios';

const BatchOpenScreen = () => {
  const [openingCashAmount, setOpeningCashAmount] = useState('');
  const [batchNumber, setBatchNumber] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('/api/batch/open', {
        openingCashAmount
      });
      setBatchNumber(response.data.batchNumber);
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <div>
      <h1>Open Batch</h1>
      <form onSubmit={handleSubmit}>
        <label>
          Opening Cash Amount:
          <input type="number" value={openingCashAmount} onChange={(e) => setOpeningCashAmount(e.target.value)} />
        </label>
        <button type="submit">Open Batch</button>
      </form>
      {batchNumber && <p>Batch {batchNumber} opened successfully</p>}
    </div>
  );
};

export default BatchOpenScreen;
