import React from 'react';

const BatchSummaryScreen = ({ batch }) => {
  return (
    <div>
      <h1>Batch Summary</h1>
      <p>Batch Number: {batch.batchNumber}</p>
      <p>Opening Date & Time: {batch.openingDate}</p>
      <p>Closing Date & Time: {batch.closingDate}</p>
      <p>Opening Cash Amount: {batch.openingCashAmount}</p>
      <p>Closing Cash Amount: {batch.closingCashAmount}</p>
      <p>Total Sales Amount: {batch.totalSalesAmount}</p>
      <p>Payment Method Wise Breakup:</p>
      <ul>
        <li>Cash Total: {batch.cashTotal}</li>
        <li>Card Total: {batch.cardTotal}</li>
        <li>Online Transfer Total: {batch.onlineTransferTotal}</li>
      </ul>
      <p>Total Number of Orders: {batch.totalOrders}</p>
      <p>Total Discount Given: {batch.totalDiscount}</p>
      <p>Void/Cancelled Orders Count: {batch.voidOrders}</p>
    </div>
  );
};

export default BatchSummaryScreen;
