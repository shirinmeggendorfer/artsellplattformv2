import React, { useState, useEffect } from 'react';
import axios from '../../Components/auth/axios';
import { useParams } from 'react-router-dom';

const MessageConversation = () => {
  const { userId, articleId } = useParams();
  const [messages, setMessages] = useState([]);
  const [newMessage, setNewMessage] = useState('');

  useEffect(() => {
    const fetchMessages = async () => {
      try {
        const response = await axios.get(`/conversations/${userId}/${articleId}`);
        setMessages(response.data);
      } catch (error) {
        console.error('Fehler beim Laden der Nachrichten:', error);
      }
    };

    fetchMessages();
  }, [userId, articleId]);

  const handleSendMessage = async () => {
    try {
      await axios.post('/messages', {
        recipient_id: userId,
        article_id: articleId,
        body: newMessage,
      });
      setNewMessage('');
      // Reload messages after sending a new one
      const response = await axios.get(`/conversations/${userId}/${articleId}`);
      setMessages(response.data);
    } catch (error) {
      console.error('Fehler beim Senden der Nachricht:', error);
    }
  };

  return (
    <div className="light:base-color-light max-h-full h-screen">
      <div className="px-4 py-5 sm:p-6">
        {messages.map((message) => (
          <div key={message.id} className="mb-2 flex justify-between">
            <div className={`content-text flex-grow ${message.sender_id === parseInt(userId) ? 'light-color' : 'accent-color'} p-2 br-messages`}>
              <strong>{message.sender ? message.sender.name : 'Unbekannt'}:</strong> {message.body}
            </div>
            <span className="content-text">{new Date(message.created_at).toLocaleTimeString()}</span>
          </div>
        ))}
      </div>
      <div className="px-4 py-5 sm:p-6">
        <textarea
          className="form-control light-color content-text w-full p-4"
          rows="2"
          value={newMessage}
          onChange={(e) => setNewMessage(e.target.value)}
          placeholder="Nachricht schreiben..."
        />
        <div className="flex justify-end mt-2">
          <button onClick={handleSendMessage} className="px-5">
            Senden
          </button>
        </div>
      </div>
    </div>
  );
};

export default MessageConversation;
