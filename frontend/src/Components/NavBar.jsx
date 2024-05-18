import React from 'react';
import { useNavigate } from 'react-router-dom';
import '../index.css';

const Navbar = ({ isAuthenticated }) => {
  const navigate = useNavigate();

  const handleNavigation = (path) => {
    if (isAuthenticated) {
      navigate(path);
    } else {
      navigate('/login');
    }
  };

  return (
    <nav className="light-color p-4 text-white fixed inset-x-0 bottom-0 flex justify-around">
      <a href="/" className="iconHome">Startseite</a>
      <button onClick={() => handleNavigation('/messages')} className="iconMessage">Nachrichten</button>
      <button onClick={() => handleNavigation('/new-article')} className="iconAddAd">Artikel erstellen</button>
      <button onClick={() => handleNavigation('/profile/edit')} className="iconProfile">Profil</button>
    </nav>
  );
};

export default Navbar;
