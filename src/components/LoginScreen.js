import React, { useState } from 'react';
import PINKeypad from './PINKeypad';
import UserList from './UserList';

const LoginScreen = () => {
  const [selectedUser, setSelectedUser] = useState(null);
  const [pin, setPin] = useState('');
  const [error, setError] = useState(null);

  const handleUserSelect = (user) => {
    setSelectedUser(user);
  };

  const handlePinChange = (pin) => {
    setPin(pin);
  };

  const handleLogin = async () => {
    if (!selectedUser) {
      setError('Please select a user');
      return;
    }

    try {
      const response = await fetch('/api/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username: selectedUser.name, pin }),
      });

      if (response.ok) {
        // Login successful
      } else {
        setError('Invalid username or pin');
        setPin('');
      }
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <div>
      <UserList onSelect={handleUserSelect} />
      {selectedUser && (
        <div>
          <PINKeypad onChange={handlePinChange} />
          <button onClick={handleLogin}>Login</button>
          {error && <div style={{ color: 'red' }}>{error}</div>}
        </div>
      )}
    </div>
  );
};

export default LoginScreen;
