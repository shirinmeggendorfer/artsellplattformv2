import React, { useState } from 'react';
import axios from '../../Components/auth/axios';
import { useNavigate, useParams } from 'react-router-dom';

const MessageCreate = () => {
  const { recipientId, articleId } = useParams();
  const [message, setMessage] = useState('');
  const navigate = useNavigate();

  const handleSubmit = async (event) => {
    event.preventDefault();

    try {
      await axios.post('/messages', { // Sicherstellen, dass dies die richtige Route ist
        recipient_id: recipientId,
        article_id: articleId,
        body: message,
      });

      navigate(`/conversations/${recipientId}/${articleId}`); // Redirect to conversation after successful submission
    } catch (error) {
      console.error('Fehler beim Senden der Nachricht:', error);
    }
  };

  return (
    <div className="text-left mb-2 w-full px-5">
      <h2 className="h2-text leading-tight">Write Message</h2>
      <form onSubmit={handleSubmit}>
        <textarea
          className="form-control light-color content-text w-full p-4"
          rows="4"
          value={message}
          onChange={(e) => setMessage(e.target.value)}
          required
        />
        <div className="flex justify-end mt-4">
          <button type="submit" className="px-5">
            Senden
          </button>
        </div>
      </form>
    </div>
  );
};

export default MessageCreate;
