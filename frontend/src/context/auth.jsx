import React, { createContext, useContext, useState, useEffect } from 'react';
import axios from 'axios';

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [user, setUser] = useState(null);

  useEffect(() => {
    axios.get('http://localhost:8000/api/user', {
      withCredentials: true,
    })
    .then(response => {
      setIsAuthenticated(true);
      setUser(response.data);
    })
    .catch(() => {
      setIsAuthenticated(false);
      setUser(null);
    });
  }, []);

  const login = async (data) => {
    try {
      await axios.get('http://localhost:8000/sanctum/csrf-cookie', {
        withCredentials: true,
      });
      await axios.post('http://localhost:8000/login', data, {
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        withCredentials: true,
      });
      const response = await axios.get('http://localhost:8000/user', {
        withCredentials: true,
      });
      setIsAuthenticated(true);
      setUser(response.data);
    } catch (error) {
      setIsAuthenticated(false);
      setUser(null);
      console.error('Login error:', error);
    }
  };

  const logout = () => {
    axios.post('http://localhost:8000/logout', {}, {
      withCredentials: true,
    })
    .then(() => {
      setIsAuthenticated(false);
      setUser(null);
    })
    .catch(err => {
      console.error('Logout error:', err);
    });
  };

  return (
    <AuthContext.Provider value={{ isAuthenticated, user, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => useContext(AuthContext);
