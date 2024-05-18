import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useParams } from 'react-router-dom';

const MessageShow = () => {
  const { id } = useParams();
  const [message, setMessage] = useState(null);

  useEffect(() => {
    const fetchMessage = async () => {
      try {
        const response = await axios.get(`/messages/${id}`);
        setMessage(response.data);
      } catch (error) {
        console.error('Fehler beim Laden der Nachricht:', error);
      }
    };

    fetchMessage();
  }, [id]);

  if (!message) {
    return <div>Loading...</div>;
  }

  return (
    <div>
      <h2 className="h2-text">Message from {message.sender.name}</h2>
      <p>{message.body}</p>
    </div>
  );
};

export default MessageShow;
