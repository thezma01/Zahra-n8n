import { useState } from 'react';

const usePIN = () => {
  const [pin, setPin] = useState('');

  const handlePinChange = (pin) => {
    setPin(pin);
  };

  const validatePIN = async (pin) => {
    try {
      const response = await fetch('/api/validate-pin', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ pin }),
      });

      if (response.ok) {
        return true;
      } else {
        return false;
      }
    } catch (error) {
      console.error(error);
      return false;
    }
  };

  return { pin, handlePinChange, validatePIN };
};

export default usePIN;
