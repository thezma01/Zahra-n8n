import React from 'react';
import LoginScreen from '../components/LoginScreen';
import { AuthProvider } from '../hooks/useAuth';
import '../styles/auth.css';

const AuthPage: React.FC = () => {
  return (
    <AuthProvider>
      <LoginScreen />
    </AuthProvider>
  );
};

export default AuthPage;
