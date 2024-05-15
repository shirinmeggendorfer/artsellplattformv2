import React, { useState, useEffect } from 'react';

const MessageConversation = () => {
  const [messages, setMessages] = useState([]);
  const [groupedMessages, setGroupedMessages] = useState({});

  useEffect(() => {
    // Fetch messages from API and group them by date
    // Dummy data and logic here; replace with your API call logic
    const fetchedMessages = [
      { id: 1, body: 'Hello!', createdAt: '2024-05-12T12:00:00', senderId: 1, senderName: 'John' },
      { id: 2, body: 'Hi, how are you?', createdAt: '2024-05-12T12:05:00', senderId: 2, senderName: 'Jane' }
    ];
    const grouped = fetchedMessages.reduce((acc, message) => {
      const date = message.createdAt.split('T')[0];
      if (!acc[date]) acc[date] = [];
      acc[date].push(message);
      return acc;
    }, {});
    setGroupedMessages(grouped);
  }, []);

  return (
    <div className="light:base-color-light max-h-full h-screen">
      {Object.entries(groupedMessages).map(([date, messagesOnDate]) => (
        <div key={date} className="px-4 py-5 sm:p-6">
          <h4 className="mb-4 h3-text">{new Date(date).toLocaleDateString()}</h4>
          {messagesOnDate.map(message => (
            <div key={message.id} className="mb-2 flex justify-between">
              <div className={`content-text flex-grow ${message.senderId === 1 ? 'light-color' : 'accent-color'} p-2 br-messages`}>
                <strong>{message.senderId === 1 ? 'Du' : message.senderName[0]}:</strong>
                {message.body}
              </div>
              <span className="content-text">{new Date(message.createdAt).toLocaleTimeString()}</span>
            </div>
          ))}
        </div>
      ))}
    </div>
  );
};

export default MessageConversation;
