import React, { useState } from 'react';
import { User } from './LoginScreen';
import { authService } from '../services/authService';

interface ForgotPinFlowProps {
  user: User;
  primaryColor: string;
  onBack: () => void;
  onSuccess: () => void;
}

type Step = 'request' | 'verify' | 'reset' | 'success';

const ForgotPinFlow: React.FC<ForgotPinFlowProps> = ({
  user,
  primaryColor,
  onBack,
  onSuccess,
}) => {
  const [step, setStep] = useState<Step>('request');
  const [otp, setOtp] = useState('');
  const [newPin, setNewPin] = useState('');
  const [confirmPin, setConfirmPin] = useState('');
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);
  const [otpToken, setOtpToken] = useState('');

  const handleRequestOtp = async () => {
    setLoading(true);
    setError('');
    try {
      await authService.requestOtp(user.id);
      setStep('verify');
    } catch (err: any) {
      setError(err.message || 'Failed to send OTP. Please try again.');
    } finally {
      setLoading(false);
    }
  };

  const handleVerifyOtp = async () => {
    if (!otp.trim()) {
      setError('Please enter the OTP sent to your email.');
      return;
    }
    setLoading(true);
    setError('');
    try {
      const token = await authService.verifyOtp(user.id, otp);
      setOtpToken(token);
      setStep('reset');
    } catch (err: any) {
      setError(err.message || 'Invalid or expired OTP. Please try again.');
      setOtp('');
    } finally {
      setLoading(false);
    }
  };

  const handleResetPin = async () => {
    if (newPin.length < 4) {
      setError('PIN must be at least 4 digits.');
      return;
    }
    if (newPin !== confirmPin) {
      setError('PINs do not match. Please try again.');
      setConfirmPin('');
      return;
    }
    setLoading(true);
    setError('');
    try {
      await authService.resetPin(user.id, newPin, otpToken);
      setStep('success');
    } catch (err: any) {
      setError(err.message || 'Failed to reset PIN. Please try again.');
    } finally {
      setLoading(false);
    }
  };

  const renderStep = () => {
    switch (step) {
      case 'request':
        return (
          <div className="forgot-pin-step">
            <div className="forgot-pin-icon" style={{ background: `${primaryColor}1a` }}>
              <svg width="32" height="32" viewBox="0 0 24 24" fill={primaryColor}>
                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
              </svg>
            </div>
            <h2 className="forgot-pin-title">Reset Your PIN</h2>
            <p className="forgot-pin-desc">
              We'll send a one-time password (OTP) to your registered email address.
            </p>
            {user.email && (
              <p className="forgot-pin-email">
                <strong>{user.email.replace(/(.{2}).*(@.*)/, '$1***$2')}</strong>
              </p>
            )}
            {error && <div className="auth-error">{error}</div>}
            <button
              className="forgot-pin-btn"
              style={{ background: primaryColor }}
              onClick={handleRequestOtp}
              disabled={loading}
              type="button"
            >
              {loading ? 'Sending OTP...' : 'Send OTP to Email'}
            </button>
            <button className="forgot-pin-cancel" onClick={onBack} type="button">
              Cancel
            </button>
          </div>
        );

      case 'verify':
        return (
          <div className="forgot-pin-step">
            <div className="forgot-pin-icon" style={{ background: `${primaryColor}1a` }}>
              <svg width="32" height="32" viewBox="0 0 24 24" fill={primaryColor}>
                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z" />
              </svg>
            </div>
            <h2 className="forgot-pin-title">Enter OTP</h2>
            <p className="forgot-pin-desc">
              Enter the 6-digit OTP sent to your email. It expires in 5 minutes.
            </p>
            <input
              className="forgot-pin-input"
              type="text"
              inputMode="numeric"
              maxLength={8}
              placeholder="Enter OTP"
              value={otp}
              onChange={(e) => {
                setOtp(e.target.value.replace(/\D/g, ''));
                setError('');
              }}
              autoFocus
              style={{ borderColor: error ? '#ef4444' : primaryColor }}
            />
            {error && <div className="auth-error">{error}</div>}
            <button
              className="forgot-pin-btn"
              style={{ background: primaryColor }}
              onClick={handleVerifyOtp}
              disabled={loading}
              type="button"
            >
              {loading ? 'Verifying...' : 'Verify OTP'}
            </button>
            <button
              className="forgot-pin-cancel"
              onClick={() => { setStep('request'); setOtp(''); setError(''); }}
              type="button"
            >
              Resend OTP
            </button>
          </div>
        );

      case 'reset':
        return (
          <div className="forgot-pin-step">
            <div className="forgot-pin-icon" style={{ background: `${primaryColor}1a` }}>
              <svg width="32" height="32" viewBox="0 0 24 24" fill={primaryColor}>
                <path d="M19 7h-1V6a6 6 0 0 0-12 0v1H5a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zm-7 9a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm3-9H9V6a3 3 0 0 1 6 0v1z" />
              </svg>
            </div>
            <h2 className="forgot-pin-title">Set New PIN</h2>
            <p className="forgot-pin-desc">Choose a new secure PIN.</p>
            <input
              className="forgot-pin-input"
              type="password"
              inputMode="numeric"
              maxLength={8}
              placeholder="New PIN"
              value={newPin}
              onChange={(e) => { setNewPin(e.target.value.replace(/\D/g, '')); setError(''); }}
              autoFocus
              style={{ borderColor: error ? '#ef4444' : primaryColor }}
            />
            <input
              className="forgot-pin-input"
              type="password"
              inputMode="numeric"
              maxLength={8}
              placeholder="Confirm PIN"
              value={confirmPin}
              onChange={(e) => { setConfirmPin(e.target.value.replace(/\D/g, '')); setError(''); }}
              style={{ borderColor: error ? '#ef4444' : primaryColor }}
            />
            {error && <div className="auth-error">{error}</div>}
            <button
              className="forgot-pin-btn"
              style={{ background: primaryColor }}
              onClick={handleResetPin}
              disabled={loading}
              type="button"
            >
              {loading ? 'Saving...' : 'Save New PIN'}
            </button>
          </div>
        );

      case 'success':
        return (
          <div className="forgot-pin-step forgot-pin-step--success">
            <div className="forgot-pin-icon" style={{ background: `${primaryColor}1a` }}>
              <svg width="40" height="40" viewBox="0 0 24 24" fill={primaryColor}>
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
              </svg>
            </div>
            <h2 className="forgot-pin-title">PIN Reset Successfully!</h2>
            <p className="forgot-pin-desc">
              Your PIN has been updated. You can now log in with your new PIN.
            </p>
            <button
              className="forgot-pin-btn"
              style={{ background: primaryColor }}
              onClick={onSuccess}
              type="button"
            >
              Back to Login
            </button>
          </div>
        );
    }
  };

  return (
    <div className="auth-root" style={{ '--primary-color': primaryColor } as React.CSSProperties}>
      <div className="auth-card auth-card--forgot">
        <div className="forgot-pin-header">
          <div
            className="auth-user-avatar"
            style={{ background: primaryColor, width: 48, height: 48, fontSize: 18 }}
          >
            {(user.avatarInitials || user.name.charAt(0)).toUpperCase()}
          </div>
          <span className="forgot-pin-username">{user.name}</span>
        </div>
        {renderStep()}
      </div>
    </div>
  );
};

export default ForgotPinFlow;
