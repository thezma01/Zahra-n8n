import React, { useState } from 'react';
import NumericKeypad from './NumericKeypad';

const STEP = { EMAIL: 'email', OTP: 'otp', NEW_PIN: 'new_pin', SUCCESS: 'success' };

export default function ForgotPINFlow({ onClose, onRequestOTP, onVerifyAndReset, pinLength = 5, primaryColor = '#16a34a' }) {
  const [step, setStep] = useState(STEP.EMAIL);
  const [email, setEmail] = useState('');
  const [userId, setUserId] = useState(null);
  const [otp, setOtp] = useState('');
  const [newPin, setNewPin] = useState('');
  const [confirmPin, setConfirmPin] = useState('');
  const [activeField, setActiveField] = useState('otp');
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);

  const handleEmailSubmit = async (e) => {
    e.preventDefault();
    if (!email.trim()) return setError('Please enter your email address.');
    setError('');
    setLoading(true);
    const result = await onRequestOTP(email.trim());
    setLoading(false);
    if (result.success) {
      setUserId(result.userId);
      setStep(STEP.OTP);
    } else {
      setError(result.message || 'Failed to send OTP. Please try again.');
    }
  };

  const handleOTPKey = (key) => {
    if (key === 'del') {
      setOtp((prev) => prev.slice(0, -1));
    } else if (otp.length < 6) {
      setOtp((prev) => prev + key);
    }
  };

  const handleOTPSubmit = () => {
    if (otp.length < 4) return setError('Please enter the complete OTP.');
    setError('');
    setStep(STEP.NEW_PIN);
    setActiveField('newPin');
  };

  const handlePinKey = (key) => {
    setError('');
    if (activeField === 'newPin') {
      if (key === 'del') {
        setNewPin((prev) => prev.slice(0, -1));
      } else if (newPin.length < pinLength) {
        const updated = newPin + key;
        setNewPin(updated);
        if (updated.length === pinLength) setActiveField('confirmPin');
      }
    } else {
      if (key === 'del') {
        setConfirmPin((prev) => prev.slice(0, -1));
      } else if (confirmPin.length < pinLength) {
        setConfirmPin((prev) => prev + key);
      }
    }
  };

  const handlePinSubmit = async () => {
    if (newPin.length !== pinLength) return setError(`PIN must be ${pinLength} digits.`);
    if (newPin !== confirmPin) {
      setError('PINs do not match. Please try again.');
      setNewPin('');
      setConfirmPin('');
      setActiveField('newPin');
      return;
    }
    setError('');
    setLoading(true);
    const result = await onVerifyAndReset(userId, otp, newPin);
    setLoading(false);
    if (result.success) {
      setStep(STEP.SUCCESS);
    } else {
      setError(result.message || 'Failed to reset PIN.');
    }
  };

  const renderDots = (value, maxLength, isActive) => (
    <div className={`pin-dots ${isActive ? 'pin-dots--active' : ''}`} style={{ '--primary': primaryColor }}>
      {Array.from({ length: maxLength }).map((_, i) => (
        <span
          key={i}
          className={`pin-dot ${i < value.length ? 'pin-dot--filled' : ''}`}
          style={i < value.length ? { backgroundColor: primaryColor } : {}}
        />
      ))}
    </div>
  );

  return (
    <div className="forgot-pin-overlay" role="dialog" aria-modal="true" aria-label="Forgot PIN">
      <div className="forgot-pin-modal">
        <button type="button" className="forgot-pin-close" onClick={onClose} aria-label="Close">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" />
          </svg>
        </button>

        {step === STEP.EMAIL && (
          <div className="forgot-pin-step">
            <div className="forgot-pin-icon" style={{ backgroundColor: `${primaryColor}20`, color: primaryColor }}>
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                <polyline points="22,6 12,13 2,6" />
              </svg>
            </div>
            <h2 className="forgot-pin-title">Reset Your PIN</h2>
            <p className="forgot-pin-subtitle">Enter your registered email address to receive a one-time code.</p>
            {error && <div className="auth-error" role="alert">{error}</div>}
            <form onSubmit={handleEmailSubmit} className="forgot-pin-form">
              <input
                type="email"
                className="auth-input"
                placeholder="manager@example.com"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                autoFocus
                required
                style={{ '--primary': primaryColor }}
              />
              <button
                type="submit"
                className="auth-btn-primary"
                disabled={loading}
                style={{ backgroundColor: primaryColor }}
              >
                {loading ? <span className="btn-spinner" /> : 'Send OTP'}
              </button>
            </form>
          </div>
        )}

        {step === STEP.OTP && (
          <div className="forgot-pin-step">
            <div className="forgot-pin-icon" style={{ backgroundColor: `${primaryColor}20`, color: primaryColor }}>
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
              </svg>
            </div>
            <h2 className="forgot-pin-title">Enter OTP</h2>
            <p className="forgot-pin-subtitle">Check your email for the one-time code.</p>
            {error && <div className="auth-error" role="alert">{error}</div>}
            {renderDots(otp, 6, true)}
            <NumericKeypad onKey={handleOTPKey} primaryColor={primaryColor} />
            <button
              type="button"
              className="auth-btn-primary"
              onClick={handleOTPSubmit}
              disabled={otp.length < 4}
              style={{ backgroundColor: primaryColor }}
            >
              Verify OTP
            </button>
          </div>
        )}

        {step === STEP.NEW_PIN && (
          <div className="forgot-pin-step">
            <div className="forgot-pin-icon" style={{ backgroundColor: `${primaryColor}20`, color: primaryColor }}>
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
              </svg>
            </div>
            <h2 className="forgot-pin-title">Set New PIN</h2>
            {error && <div className="auth-error" role="alert">{error}</div>}
            <div className="new-pin-fields">
              <div className={`pin-field-group ${activeField === 'newPin' ? 'pin-field-group--active' : ''}`}>
                <label className="pin-field-label">New PIN</label>
                {renderDots(newPin, pinLength, activeField === 'newPin')}
              </div>
              <div className={`pin-field-group ${activeField === 'confirmPin' ? 'pin-field-group--active' : ''}`}>
                <label className="pin-field-label">Confirm PIN</label>
                {renderDots(confirmPin, pinLength, activeField === 'confirmPin')}
              </div>
            </div>
            <NumericKeypad onKey={handlePinKey} primaryColor={primaryColor} />
            <button
              type="button"
              className="auth-btn-primary"
              onClick={handlePinSubmit}
              disabled={loading || newPin.length !== pinLength || confirmPin.length !== pinLength}
              style={{ backgroundColor: primaryColor }}
            >
              {loading ? <span className="btn-spinner" /> : 'Reset PIN'}
            </button>
          </div>
        )}

        {step === STEP.SUCCESS && (
          <div className="forgot-pin-step forgot-pin-step--success">
            <div className="success-icon" style={{ backgroundColor: `${primaryColor}20`, color: primaryColor }}>
              <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                <polyline points="20 6 9 17 4 12" />
              </svg>
            </div>
            <h2 className="forgot-pin-title">PIN Reset!</h2>
            <p className="forgot-pin-subtitle">Your PIN has been successfully updated. You can now log in with your new PIN.</p>
            <button
              type="button"
              className="auth-btn-primary"
              onClick={onClose}
              style={{ backgroundColor: primaryColor }}
            >
              Back to Login
            </button>
          </div>
        )}
      </div>
    </div>
  );
}
