import React, { useState, useEffect } from 'react';
import axios from '../../Components/auth/axios';
import { useParams } from 'react-router-dom';

const MessageConversation = () => {
  const { userId, articleId } = useParams();
  const [messages, setMessages] = useState([]);
  const [newMessage, setNewMessage] = useState('');
  const [selectedImage, setSelectedImage] = useState(null);
  const [article, setArticle] = useState(null);
  const [articleOwner, setArticleOwner] = useState(null);

  useEffect(() => {
    const fetchArticle = async () => {
      try {
        const response = await axios.get(`/items/${articleId}`);
        const fetchedArticle = response.data;
        setArticle(fetchedArticle);
        setArticleOwner(fetchedArticle.user);
      } catch (error) {
        console.error('Fehler beim Laden des Artikels:', error);
      }
    };

    const fetchMessages = async () => {
      try {
        const response = await axios.get(`/conversations/${userId}/${articleId}`);
        setMessages(response.data);
      } catch (error) {
        console.error('Fehler beim Laden der Nachrichten:', error);
      }
    };

    fetchArticle();
    fetchMessages();
  }, [userId, articleId]);

  const handleSendMessage = async () => {
    if (!newMessage.trim() && selectedImage) {
      alert('Bitte geben Sie eine Nachricht ein, wenn Sie ein Bild hochladen.');
      return;
    }

    const formData = new FormData();
    formData.append('recipient_id', userId);
    formData.append('article_id', articleId);
    formData.append('body', newMessage);
    if (selectedImage) {
      formData.append('image', selectedImage);
    }

    try {
      await axios.post('/messages', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      });
      setNewMessage('');
      setSelectedImage(null);
      document.getElementById('fileInput').value = null; // Reset file input
      // Reload messages after sending a new one
      const response = await axios.get(`/conversations/${userId}/${articleId}`);
      setMessages(response.data);
    } catch (error) {
      console.error('Fehler beim Senden der Nachricht:', error);
    }
  };

  const handleImageChange = (e) => {
    setSelectedImage(e.target.files[0]);
  };

  return (
    <div className="base-color-light max-h-full h-screen">
      {article && articleOwner ? (
        <div className="flex items-center p-4 border-b">
          <img src={`http://localhost:8000/storage/photos/${article.photo}`} alt={article.title} className="w-16 h-16 object-cover rounded-full mr-4" />
          <div>
            <h2 className="text-xl font-bold">{article.title}</h2>
            <p className="text-gray-600">von {articleOwner.name}</p>
          </div>
        </div>
      ) : (
        <div>Lade Artikelinformationen...</div>
      )}
      <div className="px-4 py-5 sm:p-6">
        {messages.map((message) => (
          <div key={message.id} className="mb-2 flex justify-between">
            <div className={`content-text flex-grow ${message.sender_id === parseInt(userId) ? 'light-color' : 'accent-color'} p-2 br-messages`}>
              <strong>{message.sender ? message.sender.name : 'Unbekannt'}:</strong> {message.body}
              {message.image && (
                <img src={`http://localhost:8000/storage/${message.image}`} alt="Nachricht Bild" className="mt-2 max-w-xs" />
              )}
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
        <input id="fileInput" type="file" onChange={handleImageChange} className="mt-2" />
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
