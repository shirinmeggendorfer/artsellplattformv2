import React, { useState, useEffect } from 'react';

const MessageIndex = () => {
  const [conversations, setConversations] = useState([]);

  useEffect(() => {
    // Fetch conversations from an API
    // Dummy data for example
    const fetchedConversations = [
      { id: 1, latestMessage: 'Hello', senderName: 'John Doe', latestMessageDate: new Date().toISOString() },
      { id: 2, latestMessage: 'Meeting tomorrow?', senderName: 'Jane Smith', latestMessageDate: new Date().toISOString() }
    ];
    setConversations(fetchedConversations);
  }, []);

  return (
    <div className="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
      <h2 className="h2-text">Messages</h2>
      <ul className="divide-y divide-light-color">
        {conversations.map((conversation) => (
          <li key={conversation.id} className="flex items-center justify-between px-4 py-2">
            <div>
              <h3 className="h3-text">{conversation.senderName}</h3>
              <p className="content-text">{conversation.latestMessage}</p>
            </div>
            <span className="content-text">{new Date(conversation.latestMessageDate).toLocaleString()}</span>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default MessageIndex;
