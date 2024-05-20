import React, { useState, useEffect, useCallback } from 'react';
import axios from '../../Components/auth/axios';
import { Link } from 'react-router-dom';

const MessageIndex = () => {
  const [conversations, setConversations] = useState([]);
  const [user, setUser] = useState(null);

  const groupMessagesByUserAndArticle = useCallback((messages) => {
    const currentUserId = user ? user.id : null;
    if (!currentUserId) {
      return [];
    }

    const grouped = messages.reduce((acc, message) => {
      const otherUserId = message.sender_id === currentUserId ? message.recipient_id : message.sender_id;
      const key = `${Math.min(currentUserId, otherUserId)}-${Math.max(currentUserId, otherUserId)}-${message.article_id}`;
      if (!acc[key]) {
        acc[key] = [];
      }
      acc[key].push(message);
      return acc;
    }, {});

    // Return all messages grouped by user and article
    return Object.values(grouped).map(group => group);
  }, [user]);

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

    const fetchUser = async () => {
      try {
        const response = await axios.get('/user');
        setUser(response.data);
        console.log('Benutzer geladen:', response.data); // Überprüfen Sie die geladene Benutzer-ID
      } catch (error) {
        console.error('Fehler beim Laden des Benutzers:', error);
      }
    };

    fetchConversations();
    fetchUser();
  }, [groupMessagesByUserAndArticle]);

  const getOtherUser = (message, currentUserId) => {
    return message.sender_id === currentUserId ? message.recipient : message.sender;
  };

  return (
    <div className="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
      <h2 className="py-5 h2-text">
        Messages von {user ? user.id : 'Laden...'}
      </h2>
      <ul className="divide-y divide-light-color">
        {conversations.map((conversationGroup) => {
          const lastMessage = conversationGroup[conversationGroup.length - 1];
          const otherUser = getOtherUser(lastMessage, user.id);
          return (
            <li
              key={lastMessage.id}
              className={`flex items-center justify-between px-4 py-2 ${
                !lastMessage.is_read ? 'light-color' : ''
              }`}
            >
              <Link
                to={`/conversations/${
                  lastMessage.sender_id === user.id
                    ? lastMessage.recipient_id
                    : lastMessage.sender_id
                }/${lastMessage.article_id}`}
                className="flex-grow"
              >
                <div>
                  <h3 className="h3-text">{lastMessage.article.title}</h3>
                  <p className="content-text">{otherUser.name}</p>
                  <p className="content-text">{lastMessage.body}</p>
                </div>
              </Link>
              <span className="content-text">{new Date(lastMessage.created_at).toLocaleString()}</span>
            </li>
          );
        })}
      </ul>
    </div>
  );
};

export default MessageIndex;
