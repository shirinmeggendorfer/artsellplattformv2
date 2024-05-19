import React, { useState, useEffect } from 'react';
import axios from '../../Components/auth/axios';
import { Link } from 'react-router-dom';

const MessageIndex = () => {
  const [conversations, setConversations] = useState([]);

  useEffect(() => {
    const fetchConversations = async () => {
      try {
        const response = await axios.get('/messages');
        const messages = response.data;
        const groupedConversations = groupMessagesByUserAndArticle(messages);
        setConversations(groupedConversations);
      } catch (error) {
        console.error('Fehler beim Laden der Nachrichten:', error);
      }
    };

    fetchConversations();
  }, []);

  const groupMessagesByUserAndArticle = (messages) => {
    const currentUserId = parseInt(localStorage.getItem('userId')); // Assuming the userId is stored in localStorage
    const grouped = messages.reduce((acc, message) => {
      const otherUserId = message.sender_id === currentUserId ? message.recipient_id : message.sender_id;
      const key = `${Math.min(currentUserId, otherUserId)}-${Math.max(currentUserId, otherUserId)}-${message.article_id}`;
      if (!acc[key]) {
        acc[key] = [];
      }
      acc[key].push(message);
      return acc;
    }, {});

    // Nur die letzte Nachricht jeder Gruppe zurückgeben
    return Object.values(grouped).map(group => group[group.length - 1]);
  };

 
  const getOtherUser = (message, currentUserId) => {
    return message.sender_id === currentUserId ? message.recipient : message.sender;
  };

  return (
    <div className="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
      <h2 className="h2-text">Messages</h2>
      <ul className="divide-y divide-light-color">
        {conversations.map((conversation) => {
          const otherUser = getOtherUser(conversation, parseInt(conversation.sender_id));
          return (
            <li key={conversation.id} className="flex items-center justify-between px-4 py-2">
              <Link to={`/conversations/${otherUser.id}/${conversation.article_id}`} className="flex-grow">
                <div>
                  <h3 className="h3-text">{conversation.article.title}</h3>
                  <p className="content-text">{otherUser.name}</p>
                  <p className="content-text">{conversation.body}</p>
                </div>
              </Link>
              <span className="content-text">{new Date(conversation.created_at).toLocaleString()}</span>
            </li>
          );
        })}
      </ul>
    </div>
  );
};

export default MessageIndex;




