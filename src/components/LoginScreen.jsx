import React, { useState, useEffect, useCallback } from 'react';
import UserSelector from './UserSelector';
import NumericKeypad from './NumericKeypad';
import ForgotPINFlow from './ForgotPINFlow';
import '../styles/Login.css';

export default function LoginScreen({ onLogin, config = {}, users = [], loading = false }) {
  const pinLength = config.pinLength || 5;
  const primaryColor = config.primaryColor || '#16a34a';
  const appName = config.appName || 'POS System';

  const [selectedUser, setSelectedUser] = useState(null);
  const [pin, setPin] = useState('');
  const [error, setError] = useState('');
  const [shake, setShake] = useState(false);
  const [submitting, setSubmitting] = useState(false);
  const [showForgotPIN, setShowForgotPIN] = useState(false);
  const [step, setStep] = useState('select'); // 'select' | 'pin'

  useEffect(() => {
    if (pin.length === pinLength && selectedUser) {
      handleSubmitPin(pin);
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [pin]);

  const handleUserSelect = (user) => {
    setSelectedUser(user);
    setPin('');
    setError('');
    setStep('pin');
  };

  const handleKey = useCallback((key) => {
    if (submitting) return;
    setError('');
    if (key === 'del') {
      setPin((prev) => prev.slice(0, -1));
    } else if (pin.length < pinLength) {
      setPin((prev) => prev + key);
    }
  }, [pin, pinLength, submitting]);

  const handleSubmitPin = async (currentPin) => {
    if (!selectedUser || currentPin.length !== pinLength) return;
    setSubmitting(true);
    const result = await onLogin(selectedUser._id || selectedUser.id, currentPin);
    setSubmitting(false);
    if (!result.success) {
      setError(result.message || 'Incorrect PIN, please try again');
      setShake(true);
      setPin('');
      setTimeout(() => setShake(false), 600);
    }
  };

  const handleBack = () => {
    setStep('select');
    setSelectedUser(null);
    setPin('');
    setError('');
  };

  const canForgotPin = selectedUser?.role === 'manager';

  return (
    <div className="login-root" style={{ '--primary': primaryColor, '--primary-hover': config.primaryColorHover || '#15803d', '--primary-light': config.primaryColorLight || '#dcfce7' }}>
      <div className="login-container">
        {/* Header */}
        <div className="login-header">
          <div className="login-logo" style={{ backgroundColor: primaryColor }}>
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" strokeWidth="2">
              <rect x="2" y="3" width="20" height="14" rx="2" />
              <line x1="8" y1="21" x2="16" y2="21" />
              <line x1="12" y1="17" x2="12" y2="21" />
            </svg>
          </div>
          <h1 className="login-app-name">{appName}</h1>
          <p className="login-subtitle">
            {step === 'select' ? 'Select your profile to continue' : `Welcome back, ${selectedUser?.name}`}
          </p>
        </div>

        {/* Main Content */}
        <div className="login-card">
          {step === 'select' ? (
            <div className="login-section">
              <h2 className="section-title">Who are you?</h2>
              {loading ? (
                <div className="users-loading">
                  {[1, 2, 3].map((i) => <div key={i} className="user-card-skeleton" />)}
                </div>
              ) : (
                <UserSelector
                  users={users}
                  selectedUser={selectedUser}
                  onSelect={handleUserSelect}
                  primaryColor={primaryColor}
                />
              )}
            </div>
          ) : (
            <div className="login-section">
              <button type="button" className="back-btn" onClick={handleBack} aria-label="Back to user selection">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                  <polyline points="15 18 9 12 15 6" />
                </svg>
                <span>Change User</span>
              </button>

              {/* Selected User Display */}
              <div className="selected-user-display">
                <div className="selected-avatar" style={{ backgroundColor: selectedUser?.avatarColor || primaryColor }}>
                  {selectedUser?.avatarInitials || selectedUser?.name?.substring(0, 2).toUpperCase()}
                </div>
                <div>
                  <div className="selected-name">{selectedUser?.name}</div>
                  <span className={`user-role-badge user-role-badge--${selectedUser?.role}`}>
                    {selectedUser?.role === 'manager' ? '⭐ Manager' : '👤 Cashier'}
                  </span>
                </div>
              </div>

              {/* PIN Dots */}
              <div className="pin-section">
                <p className="pin-label">Enter your PIN</p>
                <div className={`pin-dots-row ${shake ? 'pin-dots-row--shake' : ''}`} aria-label={`PIN entry, ${pin.length} of ${pinLength} digits entered`}>
                  {Array.from({ length: pinLength }).map((_, i) => (
                    <span
                      key={i}
                      className={`pin-dot-lg ${i < pin.length ? 'pin-dot-lg--filled' : ''} ${submitting && i < pin.length ? 'pin-dot-lg--loading' : ''}`}
                      style={i < pin.length ? { backgroundColor: primaryColor } : {}}
                    />
                  ))}
                </div>

                {error && (
                  <div className="login-error" role="alert" aria-live="polite">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                      <circle cx="12" cy="12" r="10" />
                      <line x1="12" y1="8" x2="12" y2="12" />
                      <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    {error}
                  </div>
                )}

                {canForgotPin && (
                  <button
                    type="button"
                    className="forgot-pin-link"
                    onClick={() => setShowForgotPIN(true)}
                    style={{ color: primaryColor }}
                  >
                    Forgot PIN?
                  </button>
                )}
              </div>

              {/* Keypad */}
              <NumericKeypad
                onKey={handleKey}
                disabled={submitting}
                primaryColor={primaryColor}
              />

              {submitting && (
                <div className="login-authenticating">
                  <span className="btn-spinner" style={{ borderTopColor: primaryColor }} />
                  <span>Authenticating…</span>
                </div>
              )}
            </div>
          )}
        </div>

        <p className="login-footer">© {new Date().getFullYear()} {appName}</p>
      </div>

      {showForgotPIN && (
        <ForgotPINFlow
          onClose={() => setShowForgotPIN(false)}
          onRequestOTP={async (email) => {
            const res = await fetch('/api/auth/forgot-pin', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({ email }),
            });
            const data = await res.json();
            return res.ok ? { success: true, userId: data.userId } : { success: false, message: data.message };
          }}
          onVerifyAndReset={async (userId, otp, newPin) => {
            const res = await fetch('/api/auth/reset-pin', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({ userId, otp, newPin }),
            });
            const data = await res.json();
            return res.ok ? { success: true } : { success: false, message: data.message };
          }}
          pinLength={pinLength}
          primaryColor={primaryColor}
        />
      )}
    </div>
  );
}
