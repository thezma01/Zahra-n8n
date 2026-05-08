import React, { useState } from 'react';

const PINKeypad = ({ onChange }) => {
  const [pin, setPin] = useState('');

  const handleKeyPress = (digit) => {
    if (pin.length < 5) {
      setPin(pin + digit);
      onChange(pin + digit);
    }
  };

  const handleBackspace = () => {
    setPin(pin.slice(0, -1));
    onChange(pin.slice(0, -1));
  };

  return (
    <div>
      <input type="password" value={pin} onChange={() => {}} />
      <div>
        <button onClick={() => handleKeyPress('1')}>1</button>
        <button onClick={() => handleKeyPress('2')}>2</button>
        <button onClick={() => handleKeyPress('3')}>3</button>
      </div>
      <div>
        <button onClick={() => handleKeyPress('4')}>4</button>
        <button onClick={() => handleKeyPress('5')}>5</button>
        <button onClick={() => handleKeyPress('6')}>6</button>
      </div>
      <div>
        <button onClick={() => handleKeyPress('7')}>7</button>
        <button onClick={() => handleKeyPress('8')}>8</button>
        <button onClick={() => handleKeyPress('9')}>9</button>
      </div>
      <div>
        <button onClick={() => handleKeyPress('0')}>0</button>
        <button onClick={handleBackspace}>Backspace</button>
      </div>
    </div>
  );
};

export default PINKeypad;
