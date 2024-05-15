import React, { useState, useEffect } from 'react';

const MessageShow = ({ match }) => {
  const [message, setMessage] = useState(null);

  useEffect(() => {
    // Fetch message details based on ID
    // Dummy logic here
    setMessage({
      id: match.params.id,
      body: 'Here is the detail of the message.',
      senderName: 'John Doe'
    });
  }, [match.params.id]);

  return (
    <div>
      <h2 className="h2-text">Message from {message && message.senderName}</h2>
      <p>{message && message.body}</p>
    </div>
  );
};

export default MessageShow;
