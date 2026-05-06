import React, { useState } from 'react';
import UserSelector from './UserSelector';
import PinPad from './PinPad';
import ForgotPinFlow from './ForgotPinFlow';
import { useAuth } from '../hooks/useAuth';
import '../styles/auth.css';

export interface User {
  id: string;
  name: string;
  role: 'manager' | 'cashier';
  avatarInitials?: string;
  avatarColor?: string;
  email?: string;
}

const LoginScreen: React.FC = () => {
  const [selectedUser, setSelectedUser] = useState<User | null>(null);
  const [pin, setPin] = useState('');
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);
  const [showForgotPin, setShowForgotPin] = useState(false);

  const { login, users, pinLength, primaryColor } = useAuth();

  const handleUserSelect = (user: User) => {
    setSelectedUser(user);
    setPin('');
    setError('');
  };

  const handlePinChange = async (newPin: string) => {
    setPin(newPin);
    setError('');

    if (newPin.length === pinLength) {
      setLoading(true);
      try {
        await login(selectedUser!.id, newPin);
      } catch (err: any) {
        setError(err.message || 'Incorrect PIN, please try again');
        setPin('');
      } finally {
        setLoading(false);
      }
    }
  };

  const handleBack = () => {
    setSelectedUser(null);
    setPin('');
    setError('');
  };

  if (showForgotPin && selectedUser) {
    return (
      <ForgotPinFlow
        user={selectedUser}
        primaryColor={primaryColor}
        onBack={() => setShowForgotPin(false)}
        onSuccess={() => {
          setShowForgotPin(false);
          setSelectedUser(null);
          setPin('');
        }}
      />
    );
  }

  return (
    <div className="auth-root" style={{ '--primary-color': primaryColor } as React.CSSProperties}>
      <div className="auth-card">
        <div className="auth-logo-area">
          <div className="auth-logo-icon" style={{ background: primaryColor }}>
            <svg width="32" height="32" viewBox="0 0 24 24" fill="white">
              <path d="M19 7h-1V6a6 6 0 0 0-12 0v1H5a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zm-7 9a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm3-9H9V6a3 3 0 0 1 6 0v1z" />
            </svg>
          </div>
          <h1 className="auth-title">POS System</h1>
          <p className="auth-subtitle">
            {selectedUser ? `Enter your PIN` : 'Select your profile to continue'}
          </p>
        </div>

        {!selectedUser ? (
          <UserSelector
            users={users}
            onSelect={handleUserSelect}
            primaryColor={primaryColor}
          />
        ) : (
          <div className="auth-pin-section">
            <div className="auth-selected-user">
              <div
                className="auth-user-avatar"
                style={{ background: selectedUser.avatarColor || primaryColor }}
              >
                {selectedUser.avatarInitials || selectedUser.name.charAt(0).toUpperCase()}
              </div>
              <div className="auth-user-info">
                <span className="auth-user-name">{selectedUser.name}</span>
                <span className={`auth-role-badge auth-role-${selectedUser.role}`}>
                  {selectedUser.role.charAt(0).toUpperCase() + selectedUser.role.slice(1)}
                </span>
              </div>
              <button className="auth-back-btn" onClick={handleBack} aria-label="Back">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                </svg>
              </button>
            </div>

            <div className="auth-pin-dots">
              {Array.from({ length: pinLength }).map((_, i) => (
                <div
                  key={i}
                  className={`auth-pin-dot ${i < pin.length ? 'auth-pin-dot--filled' : ''}`}
                  style={i < pin.length ? { background: primaryColor } : {}}
                />
              ))}
            </div>

            {error && (
              <div className="auth-error">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                </svg>
                {error}
              </div>
            )}

            <PinPad
              pin={pin}
              pinLength={pinLength}
              loading={loading}
              primaryColor={primaryColor}
              onChange={handlePinChange}
            />

            {selectedUser.role === 'manager' && (
              <button
                className="auth-forgot-link"
                onClick={() => setShowForgotPin(true)}
                style={{ color: primaryColor }}
              >
                Forgot PIN?
              </button>
            )}
          </div>
        )}
      </div>
    </div>
  );
};

export default LoginScreen;
