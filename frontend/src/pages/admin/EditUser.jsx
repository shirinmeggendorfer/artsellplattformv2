import React, { useState, useEffect } from 'react';
import axios from '../../Components/auth/axios';
import { useParams, useHistory } from 'react-router-dom';

const EditUser = () => {
  const { userId } = useParams();
  const history = useHistory();
  const [user, setUser] = useState({
    name: '',
    email: '',
    password: '',
  });

  useEffect(() => {
    fetchUser();
  }, []);

  const fetchUser = async () => {
    try {
      const response = await axios.get(`/admin/users/${userId}`);
      setUser(response.data);
    } catch (error) {
      console.error('Fehler beim Laden des Benutzers:', error);
    }
  };

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
      history.push('/admin/dashboard');
    } catch (error) {
      console.error('Fehler beim Aktualisieren des Benutzers:', error);
    }
  };

  const handleDelete = async () => {
    if (window.confirm('Sind Sie sicher, dass Sie diesen Benutzer löschen möchten?')) {
      try {
        await axios.delete(`/admin/users/${userId}`);
        history.push('/admin/dashboard');
      } catch (error) {
        console.error('Fehler beim Löschen des Benutzers:', error);
      }
    }
  };

  return (
    <div className="py-12">
      <div className="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div className="overflow-hidden shadow-sm sm:rounded-lg">
          <div className="p-6">
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
          </div>
        </div>
      </div>
    </div>
  );
};

export default EditUser;
