import React, { useState, useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import axios, { getCsrfToken } from '../../Components/auth/axios';

const ItemEdit = () => {
  const { itemId } = useParams();
  const [item, setItem] = useState(null);
  const [title, setTitle] = useState('');
  const [description, setDescription] = useState('');
  const [price, setPrice] = useState('');
  const [photo, setPhoto] = useState(null);
  const [errors, setErrors] = useState({});
  const navigate = useNavigate();

  useEffect(() => {
    const fetchItem = async () => {
      const response = await axios.get(`/items/${itemId}`);
      const itemData = response.data;
      setItem(itemData);
      setTitle(itemData.title);
      setDescription(itemData.description);
      setPrice(itemData.price);
    };

    fetchItem();
  }, [itemId]);

  const handleSubmit = async (e) => {
    e.preventDefault();

    const formData = new FormData();
    formData.append('title', title);
    formData.append('description', description);
    formData.append('price', price);
    if (photo) {
      formData.append('photo', photo);
    }

    try {
      await getCsrfToken();
      const response = await axios.post(`/items/${itemId}?_method=PUT`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

      if (response.status === 200) {
        console.log('Artikel erfolgreich aktualisiert:', response.data);
        navigate('/profile/edit');
      } else {
        console.error('Fehler beim Aktualisieren des Artikels:', response);
      }
    } catch (error) {
      if (error.response && error.response.status === 422) {
        setErrors(error.response.data.errors);
      } else {
        console.error('Fehler beim Aktualisieren des Artikels:', error);
      }
    }
  };

  if (!item) {
    return <div>Loading...</div>;
  }

  return (
    <div className="py-12">
      <div className="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div className="overflow-hidden shadow-sm sm:rounded-lg">
          <div className="p-6 border-b border-gray-200">
            <form onSubmit={handleSubmit}>
              <div>
                <label htmlFor="title" className="block text-gray-700 text-sm font-bold mb-2">Titel:</label>
                <input id="title" type="text" value={title} onChange={e => setTitle(e.target.value)} className="block w-full p-5 h-10 content-text light-color mb-5" required />
                {errors.title && <div className="text-red-500">{errors.title}</div>}
              </div>

              <div>
                <label htmlFor="description" className="block text-gray-700 text-sm font-bold mb-2">Beschreibung:</label>
                <textarea id="description" value={description} onChange={e => setDescription(e.target.value)} rows="4" className="block w-full p-5 content-text light-color mb-5" required />
                {errors.description && <div className="text-red-500">{errors.description}</div>}
              </div>

              <div>
                <label htmlFor="price" className="block text-gray-700 text-sm font-bold mb-2">Preis:</label>
                <input id="price" type="number" step="0.01" value={price} onChange={e => setPrice(e.target.value)} className="block w-full p-5 h-10 text-l mb-5" required />
                {errors.price && <div className="text-red-500">{errors.price}</div>}
              </div>

              <div>
                <label htmlFor="photo" className="block text-gray-700 text-sm font-bold mb-2">Neues Bild hochladen:</label>
                <input id="photo" type="file" onChange={e => setPhoto(e.target.files[0])} className="block content-text-small mt-1 w-full" />
                {errors.photo && <div className="text-red-500">{errors.photo}</div>}
              </div>

              <div className="flex items-center justify-end mt-4">
                <button type="submit" className="content-text py-2 px-4">Speichern</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ItemEdit;
