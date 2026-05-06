import { useState, useCallback, useEffect } from 'react';

const API_BASE = process.env.REACT_APP_API_URL || '/api';

export function useAuth() {
  const [currentUser, setCurrentUser] = useState(null);
  const [token, setToken] = useState(() => localStorage.getItem('pos_token'));
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  useEffect(() => {
    if (token) {
      localStorage.setItem('pos_token', token);
    } else {
      localStorage.removeItem('pos_token');
    }
  }, [token]);

  const fetchUsers = useCallback(async () => {
    setLoading(true);
    setError(null);
    try {
      const res = await fetch(`${API_BASE}/auth/users`, {
        headers: { 'Content-Type': 'application/json' },
      });
      if (!res.ok) throw new Error('Failed to fetch users');
      const data = await res.json();
      return data.users || [];
    } catch (err) {
      setError(err.message);
      return [];
    } finally {
      setLoading(false);
    }
  }, []);

  const fetchConfig = useCallback(async () => {
    try {
      const res = await fetch(`${API_BASE}/auth/config`);
      if (!res.ok) return { pinLength: 5, primaryColor: '#16a34a' };
      return await res.json();
    } catch {
      return { pinLength: 5, primaryColor: '#16a34a' };
    }
  }, []);

  const loginWithPin = useCallback(async (userId, pin) => {
    setLoading(true);
    setError(null);
    try {
      const res = await fetch(`${API_BASE}/auth/login`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ userId, pin }),
      });
      const data = await res.json();
      if (!res.ok) throw Object.assign(new Error(data.message || 'Login failed'), { statusCode: res.status });
      setToken(data.token);
      setCurrentUser(data.user);
      return { success: true, user: data.user };
    } catch (err) {
      setError(err.message);
      return { success: false, message: err.message };
    } finally {
      setLoading(false);
    }
  }, []);

  const requestOTP = useCallback(async (email) => {
    setLoading(true);
    setError(null);
    try {
      const res = await fetch(`${API_BASE}/auth/forgot-pin`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email }),
      });
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Failed to send OTP');
      return { success: true, userId: data.userId, message: data.message };
    } catch (err) {
      setError(err.message);
      return { success: false, message: err.message };
    } finally {
      setLoading(false);
    }
  }, []);

  const verifyOTPAndReset = useCallback(async (userId, otp, newPin) => {
    setLoading(true);
    setError(null);
    try {
      const res = await fetch(`${API_BASE}/auth/reset-pin`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ userId, otp, newPin }),
      });
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Failed to reset PIN');
      return { success: true };
    } catch (err) {
      setError(err.message);
      return { success: false, message: err.message };
    } finally {
      setLoading(false);
    }
  }, []);

  const logout = useCallback(() => {
    setToken(null);
    setCurrentUser(null);
    localStorage.removeItem('pos_token');
  }, []);

  const hasPermission = useCallback((permission) => {
    if (!currentUser) return false;
    return currentUser.permissions?.includes(permission) || false;
  }, [currentUser]);

  return {
    currentUser,
    token,
    loading,
    error,
    fetchUsers,
    fetchConfig,
    loginWithPin,
    requestOTP,
    verifyOTPAndReset,
    logout,
    hasPermission,
    isAuthenticated: !!token && !!currentUser,
  };
}
