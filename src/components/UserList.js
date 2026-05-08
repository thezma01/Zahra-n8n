import React from 'react';

const users = [
  { id: 1, name: 'John Doe', role: 'Manager' },
  { id: 2, name: 'Jane Doe', role: 'Cashier' },
];

const UserList = ({ onSelect }) => {
  return (
    <div>
      {users.map((user) => (
        <div key={user.id}>
          <span>{user.name}</span>
          <span>{user.role}</span>
          <button onClick={() => onSelect(user)}>Select</button>
        </div>
      ))}
    </div>
  );
};

export default UserList;
