import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import axios from 'axios';
import '../../index.css';
import NavBar from '../../Components/NavBar';

const fetchItem = async (itemId) => {
  try {
    const response = await axios.get(`http://localhost:8000/api/items/${itemId}`);
    if (response.status === 200) {
      return response.data;
    }
  } catch (error) {
    console.error('Error fetching item:', error);
    return null;
  }
};

function ArticleDisplay({ isAuthenticated }) {
  const { itemId } = useParams();
  const [item, setItem] = useState(null);
  const navigate = useNavigate();

  useEffect(() => {
    if (itemId) {
      fetchItem(itemId).then(setItem);
    }
  }, [itemId]);

  if (!item) {
    return <div>Loading...</div>;
  }

  const handleContact = () => {
    if (isAuthenticated) {
      navigate(`/messages/create/${item.user.id}/${item.id}`);
    } else {
      navigate('/login');
    }
  };

  return (
    <div className="base-color-light fixed top-0 z-50 w-full mb-2 shadow">
      <div className="max-w-4xl mx-auto sm:px-6 lg:px-8 py-6">
        <div className="sm:rounded-lg">
          <div className="px-4 py-5 sm:px-6">
            <h3 className="h3-text">{item.title}</h3>
            {item.user && <p className="mt-1 max-w-2xl content-text">Verkäufer: {item.user.name}</p>}
          </div>
          <div className="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <img src={`http://localhost:8000/storage/photos/${item.photo}`} alt={item.title} />
          </div>
          <div className="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt className="h3-text">Beschreibung</dt>
            <dd className="content-text">{item.description}</dd>
          </div>
          <div className="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt className="content-text">Preis</dt>
            <dd className="content-text">{item.price} €</dd>
          </div>
        </div>
        <div className="mt-5 flex justify-end px-5">
          <button
            onClick={handleContact}
            className="light-color hover:accent-color content-text-small py-2 px-4 br-buttons"
          >
            Anschreiben
          </button>
        </div>
        <div className="mb-20"></div>
      </div>
      <NavBar />
    </div>
  );
}

export default ArticleDisplay;
