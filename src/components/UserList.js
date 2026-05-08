import React from 'react';

const UserList = ({ onSelect }) => {
  const users = [
    { name: 'John Doe', role: 'Manager' },
    { name: 'Jane Doe', role: 'Cashier' },
  ];

  return (
    <ul>
      {users.map((user) => (
        <li key={user.name}>
          <button onClick={() => onSelect(user)}>
            {user.name} ({user.role})
          </button>
        </li>
      ))}
    </ul>
  );
};

export default UserList;
