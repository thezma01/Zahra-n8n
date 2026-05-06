import React from 'react';

function getContrastColor(hexColor) {
  const hex = hexColor.replace('#', '');
  const r = parseInt(hex.substr(0, 2), 16);
  const g = parseInt(hex.substr(2, 2), 16);
  const b = parseInt(hex.substr(4, 2), 16);
  const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
  return luminance > 0.5 ? '#1f2937' : '#ffffff';
}

const AVATAR_COLORS = [
  '#16a34a', '#2563eb', '#7c3aed', '#db2777',
  '#ea580c', '#0891b2', '#65a30d', '#dc2626',
];

function getAvatarColor(name, customColor) {
  if (customColor && customColor !== '#16a34a') return customColor;
  let hash = 0;
  for (let i = 0; i < name.length; i++) {
    hash = name.charCodeAt(i) + ((hash << 5) - hash);
  }
  return AVATAR_COLORS[Math.abs(hash) % AVATAR_COLORS.length];
}

function UserCard({ user, isSelected, onClick, primaryColor }) {
  const avatarBg = getAvatarColor(user.name, user.avatarColor);
  const textColor = getContrastColor(avatarBg);
  const initials = user.avatarInitials || user.initials || user.name.substring(0, 2).toUpperCase();

  return (
    <button
      type="button"
      className={`user-card${isSelected ? ' user-card--selected' : ''}`}
      onClick={() => onClick(user)}
      aria-pressed={isSelected}
      aria-label={`Select ${user.name}, ${user.role}`}
      style={{ '--primary': primaryColor }}
    >
      <div
        className="user-avatar"
        style={{ backgroundColor: avatarBg, color: textColor }}
        aria-hidden="true"
      >
        {initials}
      </div>
      <div className="user-info">
        <span className="user-name">{user.name}</span>
        <span className={`user-role-badge user-role-badge--${user.role}`}>
          {user.role === 'manager' ? '⭐ Manager' : '👤 Cashier'}
        </span>
      </div>
      {isSelected && (
        <div className="user-selected-indicator" style={{ backgroundColor: primaryColor }}>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" strokeWidth="3">
            <polyline points="20 6 9 17 4 12" />
          </svg>
        </div>
      )}
    </button>
  );
}

export default function UserSelector({ users, selectedUser, onSelect, primaryColor = '#16a34a' }) {
  if (!users || users.length === 0) {
    return (
      <div className="user-selector-empty">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" strokeWidth="1.5">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
          <circle cx="9" cy="7" r="4" />
          <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
          <path d="M16 3.13a4 4 0 0 1 0 7.75" />
        </svg>
        <p>No users available</p>
      </div>
    );
  }

  return (
    <div className="user-selector" role="list" aria-label="Select your profile">
      {users.map((user) => (
        <UserCard
          key={user._id || user.id}
          user={user}
          isSelected={selectedUser && (selectedUser._id || selectedUser.id) === (user._id || user.id)}
          onClick={onSelect}
          primaryColor={primaryColor}
        />
      ))}
    </div>
  );
}
