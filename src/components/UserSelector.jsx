'use strict';

import React from 'react';

/**
 * UserSelector — Displays a grid of users to tap/click for login.
 * Props:
 *   users: Array<{ id, name, role, avatarUrl, initials }>
 *   loading: boolean
 *   onSelect: (user) => void
 */
export default function UserSelector({ users, loading, onSelect }) {
  if (loading) {
    return (
      <div className="pos-user-selector">
        <div className="pos-user-selector__loading" aria-live="polite" aria-busy="true">
          <div className="pos-skeleton-grid">
            {Array.from({ length: 4 }).map((_, i) => (
              <div key={i} className="pos-user-skeleton" aria-hidden="true">
                <div className="pos-user-skeleton__avatar" />
                <div className="pos-user-skeleton__name" />
                <div className="pos-user-skeleton__role" />
              </div>
            ))}
          </div>
          <p className="pos-user-selector__loading-text">Loading users…</p>
        </div>
      </div>
    );
  }

  if (!users || users.length === 0) {
    return (
      <div className="pos-user-selector">
        <div className="pos-user-selector__empty" role="status">
          <span className="pos-user-selector__empty-icon" aria-hidden="true">👤</span>
          <p className="pos-user-selector__empty-text">No users found.</p>
          <p className="pos-user-selector__empty-sub">
            Please contact your administrator.
          </p>
        </div>
      </div>
    );
  }

  return (
    <div className="pos-user-selector" role="list" aria-label="Select a user to sign in">
      <div className="pos-user-grid">
        {users.map((user) => (
          <button
            key={user.id}
            className="pos-user-card"
            onClick={() => onSelect(user)}
            role="listitem"
            aria-label={`Sign in as ${user.name}, ${user.role}`}
            type="button"
          >
            <div className={`pos-user-avatar pos-user-avatar--md`}>
              {user.avatarUrl ? (
                <img
                  src={user.avatarUrl}
                  alt={`${user.name} avatar`}
                  className="pos-user-avatar__img"
                  onError={(e) => {
                    e.currentTarget.style.display = 'none';
                    e.currentTarget.nextSibling.style.display = 'flex';
                  }}
                />
              ) : null}
              <span
                className="pos-user-avatar__initials"
                style={user.avatarUrl ? { display: 'none' } : {}}
                aria-hidden="true"
              >
                {user.initials || getInitials(user.name)}
              </span>
            </div>

            <span className="pos-user-card__name">{user.name}</span>

            <span className={`pos-role-badge pos-role-badge--${user.role}`}>
              {user.role === 'manager' ? '⭐ Manager' : '🏷️ Cashier'}
            </span>
          </button>
        ))}
      </div>
    </div>
  );
}

/**
 * Fallback initials generator (in case API doesn't return them).
 * @param {string} name
 * @returns {string}
 */
function getInitials(name) {
  if (!name) return '??';
  const parts = name.trim().split(/\s+/);
  if (parts.length === 1) return parts[0].substring(0, 2).toUpperCase();
  return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
}
