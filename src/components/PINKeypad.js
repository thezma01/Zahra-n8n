import React, { useState } from 'react';

const PINKeypad = ({ onChange, value }) => {
  const [digits, setDigits] = useState(['', '', '', '', '']);

  const handleDigitClick = (digit) => {
    const newValue = [...digits];
    for (let i = 0; i < newValue.length; i++) {
      if (newValue[i] === '') {
        newValue[i] = digit;
        break;
      }
    }
    setDigits(newValue);
    onChange(newValue.join(''));
  };

  const handleBackspace = () => {
    const newValue = [...digits];
    for (let i = newValue.length - 1; i >= 0; i--) {
      if (newValue[i] !== '') {
        newValue[i] = '';
        break;
      }
    }
    setDigits(newValue);
    onChange(newValue.join(''));
  };

  return (
    <div>
      <div>
        {digits.map((digit, index) => (
          <span key={index}>{digit ? '*' : ''}</span>
        ))}
      </div>
      <div>
        <button onClick={() => handleDigitClick('1')}>1</button>
        <button onClick={() => handleDigitClick('2')}>2</button>
        <button onClick={() => handleDigitClick('3')}>3</button>
      </div>
      <div>
        <button onClick={() => handleDigitClick('4')}>4</button>
        <button onClick={() => handleDigitClick('5')}>5</button>
        <button onClick={() => handleDigitClick('6')}>6</button>
      </div>
      <div>
        <button onClick={() => handleDigitClick('7')}>7</button>
        <button onClick={() => handleDigitClick('8')}>8</button>
        <button onClick={() => handleDigitClick('9')}>9</button>
      </div>
      <div>
        <button onClick={() => handleDigitClick('0')}>0</button>
        <button onClick={handleBackspace}>Backspace</button>
      </div>
    </div>
  );
};

export default PINKeypad;
