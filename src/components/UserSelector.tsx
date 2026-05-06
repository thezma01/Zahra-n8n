import React from 'react';
import { User } from './LoginScreen';

interface UserSelectorProps {
  users: User[];
  onSelect: (user: User) => void;
  primaryColor: string;
}

const AVATAR_COLORS = [
  '#16a34a', '#2563eb', '#7c3aed', '#db2777',
  '#ea580c', '#0891b2', '#65a30d', '#dc2626',
];

const getAvatarColor = (id: string): string => {
  const index = id.charCodeAt(0) % AVATAR_COLORS.length;
  return AVATAR_COLORS[index];
};

const getInitials = (name: string): string => {
  const parts = name.trim().split(' ');
  if (parts.length >= 2) {
    return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
  }
  return name.slice(0, 2).toUpperCase();
};

const UserSelector: React.FC<UserSelectorProps> = ({ users, onSelect, primaryColor }) => {
  if (users.length === 0) {
    return (
      <div className="user-selector-empty">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="#9ca3af">
          <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
        </svg>
        <p>No users found. Please contact your administrator.</p>
      </div>
    );
  }

  return (
    <div className="user-selector-grid">
      {users.map((user) => {
        const avatarColor = user.avatarColor || getAvatarColor(user.id);
        const initials = user.avatarInitials || getInitials(user.name);

        return (
          <button
            key={user.id}
            className="user-card"
            onClick={() => onSelect({ ...user, avatarColor, avatarInitials: initials })}
            type="button"
            aria-label={`Select user ${user.name}`}
            style={{ '--hover-color': primaryColor } as React.CSSProperties}
          >
            <div className="user-card-avatar" style={{ background: avatarColor }}>
              {initials}
            </div>
            <div className="user-card-name">{user.name}</div>
            <span className={`user-card-role user-card-role--${user.role}`}>
              {user.role.charAt(0).toUpperCase() + user.role.slice(1)}
            </span>
          </button>
        );
      })}
    </div>
  );
};

export default UserSelector;
