import React, { useState, useEffect } from 'react';
import axios, { getCsrfToken } from './Components/auth/axios';
import './index.css';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import ArticleDisplay from './pages/article/ArticleDisplay';
import ArticleCreate from './pages/article/ArticleCreate';
import ArticleEdit from './pages/article/ArticleEdit';
import StartPage from './Components/StartPage';
import Login from './pages/auth/Login';
import Register from './pages/auth/Register';
import Navbar from './Components/NavBar';
import EditProfile from './pages/profile/edit';
import PrivateRoute from './Components/PrivateRoute';
import MessageCreate from './pages/messages/MessageCreate';
import MessageIndex from './pages/messages/MessageIndex';
import MessageConversation from './pages/messages/MessageConversation';  // Korrektur des Imports

function Layout({ children, isAuthenticated }) {
  return (
    <div>
      <header className="light:base-color-light dark:base-color-dark">
        <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          {/* Hier könnte dynamischer Inhalt oder Navigation sein */}
        </div>
      </header>
      <main>{children}</main>
      <Navbar isAuthenticated={isAuthenticated} />
    </div>
  );
}

function App() {
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [user, setUser] = useState(null);

  useEffect(() => {
    getCsrfToken().then(() => {
      axios.get('/user')
        .then(response => {
          setIsAuthenticated(true);
          setUser(response.data);
        })
        .catch(() => {
          setIsAuthenticated(false);
          setUser(null);
        });
    });
  }, []);

  const login = async (data) => {
    try {
      await getCsrfToken();
      await axios.post('/login', data);
      const response = await axios.get('/user');
      setIsAuthenticated(true);
      setUser(response.data);
    } catch (error) {
      setIsAuthenticated(false);
      setUser(null);
      console.error('Login error:', error);
    }
  };

  const logout = async () => {
    try {
      await getCsrfToken();
      await axios.post('/logout');
      setIsAuthenticated(false);
      setUser(null);
    } catch (error) {
      console.error('Logout error:', error);
    }
  };

  return (
    <Router>
      <Layout isAuthenticated={isAuthenticated}>
        <Routes>
          <Route path="/" element={<StartPage />} />
          <Route path="/items/:itemId" element={<ArticleDisplay isAuthenticated={isAuthenticated} />} />
          <Route path="/login" element={<Login login={login} />} />
          <Route path="/register" element={<Register login={login} />} />
          <Route path="/profile/edit" element={
            <PrivateRoute isAuthenticated={isAuthenticated}>
              <EditProfile isAuthenticated={isAuthenticated} user={user} logout={logout} />
            </PrivateRoute>
          } />
          <Route path="/messages" element={
            <PrivateRoute isAuthenticated={isAuthenticated}>
              <MessageIndex />
            </PrivateRoute>
          } />
             <Route path="/messages/create/:recipientId/:articleId" element={
            <PrivateRoute isAuthenticated={isAuthenticated}>
              <MessageCreate />
            </PrivateRoute>
          } />
          <Route path="/conversations/:userId/:articleId" element={
            <PrivateRoute isAuthenticated={isAuthenticated}>
              <MessageConversation />
            </PrivateRoute>
          } />
          <Route path="/new-article" element={
            <PrivateRoute isAuthenticated={isAuthenticated}>
              <ArticleCreate />
            </PrivateRoute>
          } />
          <Route path="/items/:itemId/edit" element={
            <PrivateRoute isAuthenticated={isAuthenticated}>
              <ArticleEdit />
            </PrivateRoute>
          } />
        </Routes>
      </Layout>
    </Router>
  );
}

export default App;
