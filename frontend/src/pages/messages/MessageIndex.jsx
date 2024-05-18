// frontend/src/pages/messages/MessageIndex.jsx

import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

const MessageIndex = () => {
  const [conversations, setConversations] = useState([]);

  useEffect(() => {
    const fetchConversations = async () => {
      try {
        const response = await axios.get('/messages');
        setConversations(response.data);
      } catch (error) {
        console.error('Fehler beim Laden der Nachrichten:', error);
      }
    };

    fetchConversations();
  }, []);

  return (
    <div className="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
      <h2 className="h2-text">Messages</h2>
      <ul className="divide-y divide-light-color">
        {conversations.map((conversation) => (
          <li key={conversation.id} className="flex items-center justify-between px-4 py-2">
            <div>
              <h3 className="h3-text">{conversation.sender.name}</h3>
              <p className="content-text">{conversation.body}</p>
            </div>
            <Link to={`/conversations/${conversation.sender.id}/${conversation.article_id}`} className="content-text">
              {new Date(conversation.created_at).toLocaleString()}
            </Link>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default MessageIndex;
