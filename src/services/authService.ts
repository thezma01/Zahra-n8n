import { User } from '../components/LoginScreen';

const API_BASE = process.env.REACT_APP_API_URL || '/api';

export interface LoginResponse {
  token: string;
  refreshToken: string;
  user: {
    id: string;
    name: string;
    role: 'manager' | 'cashier';
    email?: string;
    permissions: string[];
  };
  expiresAt: string;
}

export interface AuthSettings {
  pinLength: number;
  primaryColor: string;
  appName: string;
  otpLength: number;
  otpExpiryMinutes: number;
}

export interface ApiUser {
  id: string;
  name: string;
  role: 'manager' | 'cashier';
  email?: string;
  avatarInitials?: string;
  avatarColor?: string;
}

class AuthService {
  private getHeaders(): HeadersInit {
    return {
      'Content-Type': 'application/json',
      Accept: 'application/json',
    };
  }

  private getAuthHeaders(): HeadersInit {
    const token = this.getStoredToken();
    return {
      ...this.getHeaders(),
      ...(token ? { Authorization: `Bearer ${token}` } : {}),
    };
  }

  private async handleResponse<T>(response: Response): Promise<T> {
    if (!response.ok) {
      const data = await response.json().catch(() => ({}));
      throw new Error(data.message || `Request failed with status ${response.status}`);
    }
    return response.json();
  }

  async login(userId: string, pin: string): Promise<LoginResponse> {
    const response = await fetch(`${API_BASE}/auth/login`, {
      method: 'POST',
      headers: this.getHeaders(),
      body: JSON.stringify({ userId, pin }),
    });
    const data = await this.handleResponse<LoginResponse>(response);
    this.storeToken(data.token, data.refreshToken);
    return data;
  }

  async logout(): Promise<void> {
    const token = this.getStoredToken();
    if (token) {
      try {
        await fetch(`${API_BASE}/auth/logout`, {
          method: 'POST',
          headers: this.getAuthHeaders(),
        });
      } catch {
        // Silently fail — clear local state regardless
      }
    }
    this.clearTokens();
  }

  async getUsers(): Promise<ApiUser[]> {
    const response = await fetch(`${API_BASE}/auth/users`, {
      method: 'GET',
      headers: this.getHeaders(),
    });
    return this.handleResponse<ApiUser[]>(response);
  }

  async getSettings(): Promise<AuthSettings> {
    const response = await fetch(`${API_BASE}/auth/settings`, {
      method: 'GET',
      headers: this.getHeaders(),
    });
    return this.handleResponse<AuthSettings>(response);
  }

  async requestOtp(userId: string): Promise<{ message: string }> {
    const response = await fetch(`${API_BASE}/auth/otp/request`, {
      method: 'POST',
      headers: this.getHeaders(),
      body: JSON.stringify({ userId }),
    });
    return this.handleResponse<{ message: string }>(response);
  }

  async verifyOtp(userId: string, otp: string): Promise<string> {
    const response = await fetch(`${API_BASE}/auth/otp/verify`, {
      method: 'POST',
      headers: this.getHeaders(),
      body: JSON.stringify({ userId, otp }),
    });
    const data = await this.handleResponse<{ resetToken: string }>(response);
    return data.resetToken;
  }

  async resetPin(userId: string, newPin: string, resetToken: string): Promise<{ message: string }> {
    const response = await fetch(`${API_BASE}/auth/pin/reset`, {
      method: 'POST',
      headers: this.getHeaders(),
      body: JSON.stringify({ userId, newPin, resetToken }),
    });
    return this.handleResponse<{ message: string }>(response);
  }

  async refreshAccessToken(): Promise<string | null> {
    const refreshToken = localStorage.getItem('pos_refresh_token');
    if (!refreshToken) return null;

    try {
      const response = await fetch(`${API_BASE}/auth/token/refresh`, {
        method: 'POST',
        headers: this.getHeaders(),
        body: JSON.stringify({ refreshToken }),
      });
      const data = await this.handleResponse<{ token: string }>(response);
      localStorage.setItem('pos_token', data.token);
      return data.token;
    } catch {
      this.clearTokens();
      return null;
    }
  }

  storeToken(token: string, refreshToken?: string): void {
    localStorage.setItem('pos_token', token);
    if (refreshToken) {
      localStorage.setItem('pos_refresh_token', refreshToken);
    }
  }

  getStoredToken(): string | null {
    return localStorage.getItem('pos_token');
  }

  clearTokens(): void {
    localStorage.removeItem('pos_token');
    localStorage.removeItem('pos_refresh_token');
    localStorage.removeItem('pos_user');
  }

  storeUser(user: LoginResponse['user']): void {
    localStorage.setItem('pos_user', JSON.stringify(user));
  }

  getStoredUser(): LoginResponse['user'] | null {
    const raw = localStorage.getItem('pos_user');
    if (!raw) return null;
    try {
      return JSON.parse(raw);
    } catch {
      return null;
    }
  }

  isAuthenticated(): boolean {
    return !!this.getStoredToken();
  }
}

export const authService = new AuthService();
export default authService;
