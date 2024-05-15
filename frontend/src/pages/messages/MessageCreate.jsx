import React, { useState } from 'react';

const MessageCreate = () => {
  const [message, setMessage] = useState('');
  const [recipientId, setRecipientId] = useState('');  // Should be set according to context or input
  const [articleId, setArticleId] = useState('');  // Should be set based on selected article

  const handleSubmit = (event) => {
    event.preventDefault();
    console.log('Sending message:', message, 'to recipient ID:', recipientId, 'about article ID:', articleId);
    // Add POST request logic here
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
