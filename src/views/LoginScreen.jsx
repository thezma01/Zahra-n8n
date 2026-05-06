'use strict';

import React, { useState, useEffect, useCallback } from 'react';
import UserSelector from '../components/UserSelector';
import PinKeypad from '../components/PinKeypad';
import '../styles/login.css';

const API_BASE = process.env.REACT_APP_API_URL || '/api';

const SCREEN = {
  USER_SELECT: 'USER_SELECT',
  PIN_ENTRY: 'PIN_ENTRY',
  FORGOT_PIN_REQUEST: 'FORGOT_PIN_REQUEST',
  FORGOT_PIN_OTP: 'FORGOT_PIN_OTP',
  FORGOT_PIN_RESET: 'FORGOT_PIN_RESET',
  FORGOT_PIN_SUCCESS: 'FORGOT_PIN_SUCCESS',
};

export default function LoginScreen({ onLoginSuccess }) {
  const [screen, setScreen] = useState(SCREEN.USER_SELECT);
  const [config, setConfig] = useState({
    pinLength: 5,
    otpLength: 6,
    otpExpiryMinutes: 5,
    primaryColor: '#16a34a',
    primaryColorHover: '#15803d',
    appName: 'POS System',
    logoUrl: '/assets/logo.png',
    autoLogoutMinutes: 30,
  });
  const [users, setUsers] = useState([]);
  const [selectedUser, setSelectedUser] = useState(null);
  const [pin, setPin] = useState('');
  const [otp, setOtp] = useState('');
  const [newPin, setNewPin] = useState('');
  const [confirmPin, setConfirmPin] = useState('');
  const [pinStep, setPinStep] = useState('new'); // 'new' | 'confirm'
  const [resetToken, setResetToken] = useState('');
  const [maskedEmail, setMaskedEmail] = useState('');
  const [error, setError] = useState('');
  const [info, setInfo] = useState('');
  const [loading, setLoading] = useState(false);
  const [loadingUsers, setLoadingUsers] = useState(true);
  const [lockedUntil, setLockedUntil] = useState(null);

  // Load config + users on mount
  useEffect(() => {
    fetchConfig();
    fetchUsers();
  }, []);

  // Auto-clear error after 4 seconds
  useEffect(() => {
    if (!error) return;
    const t = setTimeout(() => setError(''), 4000);
    return () => clearTimeout(t);
  }, [error]);

  // Apply primary color CSS variable
  useEffect(() => {
    document.documentElement.style.setProperty('--pos-primary', config.primaryColor);
    document.documentElement.style.setProperty('--pos-primary-hover', config.primaryColorHover);
  }, [config.primaryColor, config.primaryColorHover]);

  async function fetchConfig() {
    try {
      const res = await fetch(`${API_BASE}/auth/config`);
      const json = await res.json();
      if (json.success) setConfig(json.data);
    } catch {
      // Use defaults
    }
  }

  async function fetchUsers() {
    setLoadingUsers(true);
    try {
      const res = await fetch(`${API_BASE}/auth/users`);
      const json = await res.json();
      if (json.success) setUsers(json.data);
    } catch {
      setError('Failed to load users. Please check your connection.');
    } finally {
      setLoadingUsers(false);
    }
  }

  function handleSelectUser(user) {
    setSelectedUser(user);
    setPin('');
    setError('');
    setInfo('');
    setLockedUntil(null);
    setScreen(SCREEN.PIN_ENTRY);
  }

  function handleBackToUsers() {
    setSelectedUser(null);
    setPin('');
    setError('');
    setInfo('');
    setScreen(SCREEN.USER_SELECT);
  }

  const handlePinChange = useCallback((digit) => {
    if (loading) return;
    setError('');
    setPin((prev) => {
      if (prev.length >= config.pinLength) return prev;
      return prev + digit;
    });
  }, [loading, config.pinLength]);

  const handlePinDelete = useCallback(() => {
    setPin((prev) => prev.slice(0, -1));
    setError('');
  }, []);

  const handlePinClear = useCallback(() => {
    setPin('');
    setError('');
  }, []);

  // Auto-submit when PIN is complete
  useEffect(() => {
    if (screen === SCREEN.PIN_ENTRY && pin.length === config.pinLength) {
      submitLogin();
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [pin, screen]);

  async function submitLogin() {
    if (!selectedUser || pin.length !== config.pinLength) return;
    setLoading(true);
    try {
      const res = await fetch(`${API_BASE}/auth/login`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ userId: selectedUser.id, pin }),
      });
      const json = await res.json();

      if (res.status === 423) {
        setLockedUntil(json.lockedUntil);
        setError(json.message);
        setPin('');
        return;
      }

      if (!json.success) {
        setError(json.message || 'Incorrect PIN. Please try again.');
        setPin('');
        return;
      }

      // Persist tokens
      localStorage.setItem('pos_access_token', json.data.accessToken);
      localStorage.setItem('pos_refresh_token', json.data.refreshToken);

      if (onLoginSuccess) {
        onLoginSuccess(json.data);
      }
    } catch {
      setError('Login failed. Please check your connection.');
      setPin('');
    } finally {
      setLoading(false);
    }
  }

  async function handleForgotPinRequest() {
    if (!selectedUser) return;
    setLoading(true);
    setError('');
    try {
      const res = await fetch(`${API_BASE}/auth/forgot-pin/request`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ userId: selectedUser.id }),
      });
      const json = await res.json();
      if (!json.success) {
        setError(json.message);
        return;
      }
      setMaskedEmail(json.data.maskedEmail);
      setOtp('');
      setError('');
      setInfo(json.message);
      setScreen(SCREEN.FORGOT_PIN_OTP);
    } catch {
      setError('Failed to send OTP. Please try again.');
    } finally {
      setLoading(false);
    }
  }

  // OTP digit input handler
  const handleOtpDigit = useCallback((digit) => {
    if (loading) return;
    setOtp((prev) => {
      if (prev.length >= config.otpLength) return prev;
      return prev + digit;
    });
    setError('');
  }, [loading, config.otpLength]);

  const handleOtpDelete = useCallback(() => {
    setOtp((prev) => prev.slice(0, -1));
    setError('');
  }, []);

  // Auto-submit OTP when complete
  useEffect(() => {
    if (screen === SCREEN.FORGOT_PIN_OTP && otp.length === config.otpLength) {
      submitVerifyOtp();
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [otp, screen]);

  async function submitVerifyOtp() {
    setLoading(true);
    setError('');
    try {
      const res = await fetch(`${API_BASE}/auth/forgot-pin/verify`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ userId: selectedUser.id, otp }),
      });
      const json = await res.json();
      if (!json.success) {
        setError(json.message);
        setOtp('');
        return;
      }
      setResetToken(json.data.resetToken);
      setNewPin('');
      setConfirmPin('');
      setPinStep('new');
      setInfo('');
      setScreen(SCREEN.FORGOT_PIN_RESET);
    } catch {
      setError('OTP verification failed. Please try again.');
      setOtp('');
    } finally {
      setLoading(false);
    }
  }

  const handleResetPinDigit = useCallback((digit) => {
    if (loading) return;
    setError('');
    if (pinStep === 'new') {
      setNewPin((prev) => {
        if (prev.length >= config.pinLength) return prev;
        return prev + digit;
      });
    } else {
      setConfirmPin((prev) => {
        if (prev.length >= config.pinLength) return prev;
        return prev + digit;
      });
    }
  }, [loading, pinStep, config.pinLength]);

  const handleResetPinDelete = useCallback(() => {
    setError('');
    if (pinStep === 'new') {
      setNewPin((prev) => prev.slice(0, -1));
    } else {
      setConfirmPin((prev) => prev.slice(0, -1));
    }
  }, [pinStep]);

  // Auto-advance new PIN step
  useEffect(() => {
    if (screen === SCREEN.FORGOT_PIN_RESET && pinStep === 'new' && newPin.length === config.pinLength) {
      setTimeout(() => setPinStep('confirm'), 200);
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [newPin, pinStep, screen]);

  // Auto-submit confirm PIN
  useEffect(() => {
    if (screen === SCREEN.FORGOT_PIN_RESET && pinStep === 'confirm' && confirmPin.length === config.pinLength) {
      submitResetPin();
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [confirmPin, pinStep, screen]);

  async function submitResetPin() {
    if (newPin !== confirmPin) {
      setError('PINs do not match. Please try again.');
      setConfirmPin('');
      setPinStep('new');
      setNewPin('');
      return;
    }
    setLoading(true);
    setError('');
    try {
      const res = await fetch(`${API_BASE}/auth/forgot-pin/reset`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ resetToken, newPin }),
      });
      const json = await res.json();
      if (!json.success) {
        setError(json.message);
        setConfirmPin('');
        setPinStep('new');
        setNewPin('');
        return;
      }
      setScreen(SCREEN.FORGOT_PIN_SUCCESS);
    } catch {
      setError('Failed to reset PIN. Please try again.');
    } finally {
      setLoading(false);
    }
  }

  function handleReturnToLogin() {
    setScreen(SCREEN.PIN_ENTRY);
    setPin('');
    setOtp('');
    setNewPin('');
    setConfirmPin('');
    setResetToken('');
    setError('');
    setInfo('');
    setPinStep('new');
  }

  // ─── Render helpers ───────────────────────────────────────────────

  function renderHeader() {
    return (
      <div className="pos-login__header">
        <div className="pos-login__logo">
          <span className="pos-login__logo-icon" aria-hidden="true">🏪</span>
        </div>
        <h1 className="pos-login__app-name">{config.appName}</h1>
      </div>
    );
  }

  function renderErrorBanner() {
    if (!error) return null;
    return (
      <div className="pos-alert pos-alert--error" role="alert">
        <span className="pos-alert__icon">⚠️</span>
        <span>{error}</span>
      </div>
    );
  }

  function renderInfoBanner() {
    if (!info) return null;
    return (
      <div className="pos-alert pos-alert--info" role="status">
        <span className="pos-alert__icon">ℹ️</span>
        <span>{info}</span>
      </div>
    );
  }

  function renderPinDots(value, length) {
    return (
      <div className="pos-pin-dots" aria-label={`${value.length} of ${length} digits entered`}>
        {Array.from({ length }).map((_, i) => (
          <span
            key={i}
            className={`pos-pin-dot ${i < value.length ? 'pos-pin-dot--filled' : ''}`}
            aria-hidden="true"
          />
        ))}
      </div>
    );
  }

  // ─── Screens ──────────────────────────────────────────────────────

  if (screen === SCREEN.USER_SELECT) {
    return (
      <div className="pos-login">
        <div className="pos-login__card">
          {renderHeader()}
          <p className="pos-login__subtitle">Select your profile to sign in</p>
          {renderErrorBanner()}
          <UserSelector
            users={users}
            loading={loadingUsers}
            onSelect={handleSelectUser}
          />
          <button
            className="pos-login__refresh-btn"
            onClick={fetchUsers}
            disabled={loadingUsers}
            aria-label="Refresh user list"
          >
            {loadingUsers ? 'Loading…' : '↻ Refresh'}
          </button>
        </div>
      </div>
    );
  }

  if (screen === SCREEN.PIN_ENTRY) {
    return (
      <div className="pos-login">
        <div className="pos-login__card">
          {renderHeader()}

          {/* Selected user display */}
          <div className="pos-login__selected-user">
            <div className="pos-user-avatar pos-user-avatar--lg">
              {selectedUser.avatarUrl ? (
                <img src={selectedUser.avatarUrl} alt={selectedUser.name} className="pos-user-avatar__img" />
              ) : (
                <span className="pos-user-avatar__initials">{selectedUser.initials}</span>
              )}
            </div>
            <div className="pos-login__selected-info">
              <span className="pos-login__selected-name">{selectedUser.name}</span>
              <span className={`pos-role-badge pos-role-badge--${selectedUser.role}`}>
                {selectedUser.role.charAt(0).toUpperCase() + selectedUser.role.slice(1)}
              </span>
            </div>
          </div>

          <p className="pos-login__pin-label">Enter your {config.pinLength}-digit PIN</p>
          {renderPinDots(pin, config.pinLength)}
          {renderErrorBanner()}

          {lockedUntil && (
            <p className="pos-login__locked-msg">
              🔒 Account locked until {new Date(lockedUntil).toLocaleTimeString()}
            </p>
          )}

          <PinKeypad
            onDigit={handlePinChange}
            onDelete={handlePinDelete}
            onClear={handlePinClear}
            disabled={loading || !!lockedUntil}
            loading={loading}
          />

          <div className="pos-login__actions">
            <button className="pos-login__back-btn" onClick={handleBackToUsers} disabled={loading}>
              ← Back
            </button>
            {selectedUser.role === 'manager' && (
              <button
                className="pos-login__forgot-btn"
                onClick={() => setScreen(SCREEN.FORGOT_PIN_REQUEST)}
                disabled={loading}
              >
                Forgot PIN?
              </button>
            )}
          </div>
        </div>
      </div>
    );
  }

  if (screen === SCREEN.FORGOT_PIN_REQUEST) {
    return (
      <div className="pos-login">
        <div className="pos-login__card">
          {renderHeader()}
          <div className="pos-login__forgot-header">
            <div className="pos-forgot-icon">📧</div>
            <h2 className="pos-login__section-title">Reset Your PIN</h2>
            <p className="pos-login__section-desc">
              We'll send a one-time code to the email address linked to{' '}
              <strong>{selectedUser.name}</strong>'s account.
            </p>
            <p className="pos-login__section-desc">
              The code will be valid for <strong>{config.otpExpiryMinutes} minutes</strong>.
            </p>
          </div>
          {renderErrorBanner()}
          <button
            className="pos-btn pos-btn--primary"
            onClick={handleForgotPinRequest}
            disabled={loading}
          >
            {loading ? <span className="pos-spinner" /> : 'Send OTP to Email'}
          </button>
          <button
            className="pos-login__back-btn pos-login__back-btn--center"
            onClick={handleReturnToLogin}
            disabled={loading}
          >
            ← Back to Login
          </button>
        </div>
      </div>
    );
  }

  if (screen === SCREEN.FORGOT_PIN_OTP) {
    return (
      <div className="pos-login">
        <div className="pos-login__card">
          {renderHeader()}
          <div className="pos-login__forgot-header">
            <div className="pos-forgot-icon">🔢</div>
            <h2 className="pos-login__section-title">Enter OTP</h2>
            <p className="pos-login__section-desc">
              A {config.otpLength}-digit code was sent to <strong>{maskedEmail}</strong>.
              It expires in {config.otpExpiryMinutes} minutes.
            </p>
          </div>

          {renderInfoBanner()}
          {renderPinDots(otp, config.otpLength)}
          {renderErrorBanner()}

          <PinKeypad
            onDigit={handleOtpDigit}
            onDelete={handleOtpDelete}
            onClear={() => { setOtp(''); setError(''); }}
            disabled={loading}
            loading={loading}
          />

          <div className="pos-login__actions">
            <button
              className="pos-login__back-btn"
              onClick={() => {
                setScreen(SCREEN.FORGOT_PIN_REQUEST);
                setOtp('');
                setError('');
              }}
              disabled={loading}
            >
              ← Resend OTP
            </button>
            <button
              className="pos-login__back-btn"
              onClick={handleReturnToLogin}
              disabled={loading}
            >
              Cancel
            </button>
          </div>
        </div>
      </div>
    );
  }

  if (screen === SCREEN.FORGOT_PIN_RESET) {
    const currentValue = pinStep === 'new' ? newPin : confirmPin;
    const label = pinStep === 'new'
      ? `Enter new ${config.pinLength}-digit PIN`
      : `Confirm your new PIN`;

    return (
      <div className="pos-login">
        <div className="pos-login__card">
          {renderHeader()}
          <div className="pos-login__forgot-header">
            <div className="pos-forgot-icon">🔐</div>
            <h2 className="pos-login__section-title">Set New PIN</h2>
            <div className="pos-pin-step-indicator">
              <span className={`pos-pin-step ${pinStep === 'new' ? 'pos-pin-step--active' : 'pos-pin-step--done'}`}>
                {pinStep === 'new' ? '1' : '✓'}
              </span>
              <div className="pos-pin-step-line" />
              <span className={`pos-pin-step ${pinStep === 'confirm' ? 'pos-pin-step--active' : ''}`}>
                2
              </span>
            </div>
          </div>

          <p className="pos-login__pin-label">{label}</p>
          {renderPinDots(currentValue, config.pinLength)}
          {renderErrorBanner()}

          <PinKeypad
            onDigit={handleResetPinDigit}
            onDelete={handleResetPinDelete}
            onClear={() => {
              setError('');
              if (pinStep === 'new') setNewPin('');
              else setConfirmPin('');
            }}
            disabled={loading}
            loading={loading}
          />

          <button
            className="pos-login__back-btn pos-login__back-btn--center"
            onClick={handleReturnToLogin}
            disabled={loading}
          >
            Cancel
          </button>
        </div>
      </div>
    );
  }

  if (screen === SCREEN.FORGOT_PIN_SUCCESS) {
    return (
      <div className="pos-login">
        <div className="pos-login__card pos-login__card--success">
          {renderHeader()}
          <div className="pos-success-icon" aria-hidden="true">✅</div>
          <h2 className="pos-login__section-title">PIN Reset Successful</h2>
          <p className="pos-login__section-desc">
            Your PIN has been updated. You can now log in with your new PIN.
          </p>
          <button
            className="pos-btn pos-btn--primary"
            onClick={handleReturnToLogin}
          >
            Go to Login
          </button>
        </div>
      </div>
    );
  }

  return null;
}
