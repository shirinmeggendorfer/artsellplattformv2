import React, { useState, useEffect } from 'react';
import axios from '../../Components/auth/axios';
import { useParams, useNavigate } from 'react-router-dom';

const EditUser = () => {
  const { userId } = useParams();
  const navigate = useNavigate();
  const [user, setUser] = useState(null);
  const [items, setItems] = useState([]);
  const [openItems, setOpenItems] = useState(false);

  useEffect(() => {
    const fetchUser = async () => {
      try {
        const response = await axios.get(`/admin/users/${userId}`);
        setUser(response.data);
      } catch (error) {
        console.error('Fehler beim Laden des Benutzers:', error);
      }
    };

    const fetchItems = async () => {
      try {
        const response = await axios.get(`/admin/users/${userId}/items`);
        setItems(response.data);
      } catch (error) {
        console.error('Fehler beim Laden der Artikel:', error);
      }
    };

    fetchUser();
    fetchItems();
  }, [userId]);

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setUser((prevState) => ({
      ...prevState,
      [name]: value,
    }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await axios.put(`/admin/users/${userId}`, user);
      navigate('/admin/dashboard');
    } catch (error) {
      console.error('Fehler beim Aktualisieren des Benutzers:', error);
    }
  };

  const handleDelete = async () => {
    if (window.confirm('Sind Sie sicher, dass Sie diesen Benutzer löschen möchten?')) {
      try {
        await axios.delete(`/admin/users/${userId}`);
        navigate('/admin/dashboard');
      } catch (error) {
        console.error('Fehler beim Löschen des Benutzers:', error);
      }
    }
  };

  const handleItemEdit = (itemId) => {
    navigate(`/admin/items/${itemId}/edit`);
  };

  const handleItemDelete = async (itemId) => {
    if (window.confirm('Sind Sie sicher, dass Sie diesen Artikel löschen möchten?')) {
      try {
        await axios.delete(`/admin/items/${itemId}`);
        setItems(items.filter(item => item.id !== itemId));
      } catch (error) {
        console.error('Fehler beim Löschen des Artikels:', error);
      }
    }
  };

  if (!user) {
    return <div>Lade Benutzerinformationen...</div>;
  }

  return (
    <div className="py-12">
      <div className="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div className="overflow-hidden shadow-sm sm:rounded-lg">
          <div className="p-6">
            <button onClick={() => navigate('/admin/dashboard')} className="px-4 py-2 mb-4 bg-gray-200 hover:bg-gray-300 rounded-md">
              Zurück zum Dashboard
            </button>
            <form onSubmit={handleSubmit}>
              <div>
                <label htmlFor="name" className="block font-medium text-sm text-gray-700">
                  Name
                </label>
                <input
                  id="name"
                  name="name"
                  type="text"
                  className="block w-full p-5 h-10 content-text light-color mb-5"
                  value={user.name}
                  onChange={handleInputChange}
                  required
                />
              </div>

              <div>
                <label htmlFor="email" className="block font-medium text-sm text-gray-700">
                  Email
                </label>
                <input
                  id="email"
                  name="email"
                  type="email"
                  className="block w-full p-5 h-10 content-text light-color mb-5"
                  value={user.email}
                  onChange={handleInputChange}
                  required
                />
              </div>

              <div>
                <label htmlFor="password" className="block font-medium text-sm text-gray-700">
                  Neues Passwort
                </label>
                <input
                  id="password"
                  name="password"
                  type="password"
                  className="block w-full p-5 h-10 content-text light-color mb-5"
                  value={user.password}
                  onChange={handleInputChange}
                />
              </div>

              <div className="flex items-center justify-end mt-4">
                <button type="submit" className="px-5 py-2 accent-color">
                  Speichern
                </button>
                <button type="button" onClick={handleDelete} className="px-5 py-2 text-red-500 hover:text-red-700 ml-4">
                  Benutzer löschen
                </button>
              </div>
            </form>

            <div className="mt-6">
              <button onClick={() => setOpenItems(!openItems)} className="w-full flex items-center justify-between px-4 py-2 text-left content-text hover:accent-color">
                <span>Artikel anzeigen</span>
                {openItems ? (
                  <svg className="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 15l7-7 7 7" />
                  </svg>
                ) : (
                  <svg className="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" />
                  </svg>
                )}
              </button>

              {openItems && (
                <div className="mt-4 space-y-4">
                  {items.length > 0 ? (
                    items.map((item) => (
                      <div key={item.id} className="p-4 border rounded-md">
                        <h5 className="h5-text">{item.title}</h5>
                        <img src={`http://localhost:8000/storage/photos/${item.photo}`} alt={item.title} className="w-16 h-16 object-cover rounded-full mr-4" />
                        <p>{item.description}</p>
                        <div className="flex justify-end space-x-4">
                          <button
                            onClick={() => handleItemEdit(item.id)}
                            className="px-4 py-2 text-blue-500 hover:text-blue-700"
                          >
                            Bearbeiten
                          </button>
                          <button
                            onClick={() => handleItemDelete(item.id)}
                            className="px-4 py-2 text-red-500 hover:text-red-700"
                          >
                            Löschen
                          </button>
                        </div>
                      </div>
                    ))
                  ) : (
                    <p>Keine Artikel gefunden.</p>
                  )}
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default EditUser;
