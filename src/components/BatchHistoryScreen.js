import React, { useState, useEffect } from 'react';
import axios from 'axios';

const BatchHistoryScreen = () => {
  const [batchHistory, setBatchHistory] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchBatchHistory = async () => {
      try {
        const response = await axios.get('/api/batch/history');
        setBatchHistory(response.data);
        setLoading(false);
      } catch (error) {
        setError(error.message);
        setLoading(false);
      }
    };
    fetchBatchHistory();
  }, []);

  if (loading) {
    return <div>Loading...</div>;
  }

  if (error) {
    return <div>Error: {error}</div>;
  }

  return (
    <div>
      <h1>Batch History</h1>
      <table>
        <thead>
          <tr>
            <th>Batch Number</th>
            <th>Opening Date & Time</th>
            <th>Closing Date & Time</th>
            <th>Opening Cash Amount</th>
            <th>Closing Cash Amount</th>
            <th>Total Sales Amount</th>
          </tr>
        </thead>
        <tbody>
          {batchHistory.map((batch) => (
            <tr key={batch.id}>
              <td>{batch.batchNumber}</td>
              <td>{batch.openingDateTime}</td>
              <td>{batch.closingDateTime}</td>
              <td>{batch.openingCashAmount}</td>
              <td>{batch.closingCashAmount}</td>
              <td>{batch.totalSalesAmount}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default BatchHistoryScreen;
