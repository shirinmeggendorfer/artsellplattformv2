import React, { useState } from 'react';

const ItemEdit = ({ item, onUpdate }) => {
  const [title, setTitle] = useState(item.title);
  const [description, setDescription] = useState(item.description);
  const [photo, setPhoto] = useState(null);

  const handleSubmit = (e) => {
    e.preventDefault();
    const formData = new FormData();
    formData.append('title', title);
    formData.append('description', description);
    if (photo) {
      formData.append('photo', photo);
    }
    onUpdate(item.id, formData);
  };

  return (
    <div className="py-12">
      <div className="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div className="overflow-hidden shadow-sm sm:rounded-lg">
          <div className="p-6 border-b border-gray-200">
            <form onSubmit={handleSubmit}>
              <div>
                <label htmlFor="title" className="block text-gray-700 text-sm font-bold mb-2">Titel:</label>
                <input id="title" type="text" value={title} onChange={e => setTitle(e.target.value)} className="block w-full p-5 h-10 content-text light-color mb-5" required />
              </div>

              <div>
                <label htmlFor="description" className="block text-gray-700 text-sm font-bold mb-2">Beschreibung:</label>
                <textarea id="description" value={description} onChange={e => setDescription(e.target.value)} rows="4" className="block w-full p-5 content-text light-color mb-5" required />
              </div>

              <div>
                <label htmlFor="photo" className="block text-gray-700 text-sm font-bold mb-2">Neues Bild hochladen:</label>
                <input id="photo" type="file" onChange={e => setPhoto(e.target.files[0])} className="block content-text-small mt-1 w-full" />
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
