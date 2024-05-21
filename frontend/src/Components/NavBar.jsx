import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from './auth/axios';
import '../index.css';

const Navbar = ({ isAuthenticated }) => {
  const navigate = useNavigate();
  const [hasUnreadMessages, setHasUnreadMessages] = useState(false);

  useEffect(() => {
    const checkForUnreadMessages = async () => {
      try {
        const response = await axios.get('/messages/check-new'); // Update the endpoint
        setHasUnreadMessages(response.data.hasNewMessages);
      } catch (error) {
        console.error('Error checking for unread messages:', error);
      }
    };
  
    if (isAuthenticated) {
      checkForUnreadMessages();
    }
  }, [isAuthenticated]);
  

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
      <button
        onClick={() => handleNavigation('/messages')}
        className={hasUnreadMessages ? 'iconNewMessage' : 'iconMessage'}
      >
        Nachrichten
      </button>
      <button onClick={() => handleNavigation('/new-article')} className="iconAddAd">Artikel erstellen</button>
      <button onClick={() => handleNavigation('/profile/edit')} className="iconProfile">Profil</button>
    </nav>
  );
};

export default Navbar;