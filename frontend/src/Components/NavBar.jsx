import React from 'react';
import { useNavigate } from 'react-router-dom';
import '../index.css';

const Navbar = ({ isAuthenticated, logout }) => {
  const navigate = useNavigate();

  const handleLogout = () => {
    logout();
    navigate('/login');
  };

  return (
    <nav className="light-color p-4 text-white fixed inset-x-0 bottom-0 flex justify-around">
      <a href="/" className="iconHome">Startseite</a>
      {isAuthenticated ? (
        <>
          <a href="/messages" className="iconMessage">Nachrichten</a>
          <a href="/new-article" className="iconAddAd">Artikel erstellen</a>
          <a href="/profile/edit" className="iconProfile">Profil</a>
          <button onClick={handleLogout} className="iconLogout">Logout</button>
        </>
      ) : (
        <>
          <a href="/login" className="iconLogin">Login</a>
          <a href="/register" className="iconRegister">Register</a>
        </>
      )}
    </nav>
  );
};

export default Navbar;
