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

  const handlePinChange = (newPin) => {
    setPin(newPin);
  };

  const handleLogin = () => {
    if (selectedUser && pin.length === 5) {
      // TO DO: implement login logic
      console.log('Login successful');
    } else {
      setError('Incorrect PIN, please try again');
      setPin('');
    }
  };

  return (
    <div>
      <UserList onSelect={handleUserSelect} />
      {selectedUser && (
        <div>
          <PINKeypad onChange={handlePinChange} value={pin} />
          {error && <div style={{ color: 'red' }}>{error}</div>}
          <button onClick={handleLogin}>Login</button>
        </div>
      )}
    </div>
  );
};

export default LoginScreen;
