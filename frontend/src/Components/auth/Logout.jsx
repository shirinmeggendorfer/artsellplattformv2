import { useEffect, useCallback } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from './axios';

const Logout = ({ setIsAuthenticated, setUser }) => {
  const navigate = useNavigate();

  const handleLogout = useCallback(async () => {
    try {
      await axios.post('/logout');
      setIsAuthenticated(false);
      setUser(null);
      navigate('/login');
    } catch (error) {
      console.error('Logout error:', error);
    }
  }, [navigate, setIsAuthenticated, setUser]);

  useEffect(() => {
    handleLogout();
  }, [handleLogout]);

  return null;
};

export default Logout;
