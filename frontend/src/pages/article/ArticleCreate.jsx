import React, { useState } from 'react';


const postItem = async () => {
  const response = await post('http://localhost:8000/api/items');
  if (response.ok) {
    return response.json();
  }
  return [];
};

const ItemCreate = ({ onCreate }) => {
  const [title, setTitle] = useState('');
  const [description, setDescription] = useState('');
  const [price, setPrice] = useState('');
  const [photo, setPhoto] = useState(null);

  const handleSubmit = (e) => {
    e.preventDefault();
    const formData = new FormData();
    formData.append('title', title);
    formData.append('description', description);
    formData.append('price', price);
    if (photo) {
      formData.append('photo', photo);
    }
    onCreate(formData);
  };

  return (
    <div className="px-5 py-12">
      <form onSubmit={handleSubmit} className="space-y-6">
        <div>
          <label htmlFor="title" className="block text-gray-700 text-sm font-bold mb-2">Titel:</label>
          <input
            id="title"
            type="text"
            value={title}
            onChange={e => setTitle(e.target.value)}
            className="block w-full p-5 h-10 text-l mb-5"
            required
          />
        </div>

        <div>
          <label htmlFor="description" className="block text-gray-700 text-sm font-bold mb-2">Beschreibung:</label>
          <textarea
            id="description"
            rows="4"
            value={description}
            onChange={e => setDescription(e.target.value)}
            className="block w-full p-5 content-text light-color mb-5"
            required
          ></textarea>
        </div>

        <div>
          <label htmlFor="price" className="block text-gray-700 text-sm font-bold mb-2">Preis:</label>
          <input
            id="price"
            type="number"
            step="0.01"
            value={price}
            onChange={e => setPrice(e.target.value)}
            className="block w-full p-5 h-10 text-l mb-5"
            required
          />
        </div>

        <div>
          <label htmlFor="photo" className="block text-gray-700 text-sm font-bold mb-2">Foto:</label>
          <input
            id="photo"
            type="file"
            onChange={e => setPhoto(e.target.files[0])}
            className="form-control-file border-gray-300 px-4 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500"
            required
          />
        </div>

        <div className="flex justify-end">
          <button type="submit" className="content-text py-2 px-4">Artikel erstellen</button>
        </div>
      </form>
    </div>
  );
};

export default ItemCreate;
