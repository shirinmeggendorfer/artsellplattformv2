import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './index.css';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import ArticleDisplay from './pages/article/ArticleDisplay';
import StartPage from './Components/StartPage';
import Login from './pages/auth/Login';
import Register from './pages/auth/Register';
import Navbar from './Components/NavBar';
import EditProfile from './pages/profile/edit'; // Import der Profil-Edit-Komponente

// Layout Komponente
function Layout({ children, isAuthenticated, logout }) {
  return (
    <div>
      {/* Kopfbereich */}
      <header className="light:base-color-light dark:base-color-dark">
        <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          {/* Hier könnte dynamischer Inhalt oder Navigation sein */}
        </div>
      </header>
      {/* Hauptinhalt */}
      <main>{children}</main>
      <Navbar isAuthenticated={isAuthenticated} logout={logout} />
    </div>
  );
}

function App() {
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [user, setUser] = useState(null);

  useEffect(() => {
    axios.get('http://localhost:8000/api/user', { withCredentials: true })
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
      await axios.get('http://localhost:8000/sanctum/csrf-cookie', { withCredentials: true });
      await axios.post('http://localhost:8000/api/login', data, {
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        withCredentials: true,
      });
      const response = await axios.get('http://localhost:8000/api/user', { withCredentials: true });
      setIsAuthenticated(true);
      setUser(response.data);
    } catch (error) {
      setIsAuthenticated(false);
      setUser(null);
      console.error('Login error:', error);
    }
  };

  const logout = () => {
    axios.post('http://localhost:8000/api/logout', {}, { withCredentials: true })
      .then(() => {
        setIsAuthenticated(false);
        setUser(null);
      })
      .catch(err => {
        console.error('Logout error:', err);
      });
  };

  return (
    <Router>
      <Layout isAuthenticated={isAuthenticated} logout={logout}>
        <Routes>
          <Route path="/" element={<StartPage />} />
          <Route path="/items/:itemId" element={<ArticleDisplay />} />
          <Route path="/login" element={<Login login={login} />} />
          <Route path="/register" element={<Register login={login} />} />
          <Route path="/profile/edit" element={<EditProfile isAuthenticated={isAuthenticated} user={user} />} /> {/* Profil-Edit-Route */}
        </Routes>
      </Layout>
    </Router>
  );
}

export default App;
