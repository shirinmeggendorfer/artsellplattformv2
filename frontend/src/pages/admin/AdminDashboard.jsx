import React, { useState, useEffect } from 'react';
import axios from '../../Components/auth/axios';
import { Link } from 'react-router-dom';
import '../../index.css';


const AdminDashboard = () => {
  const [users, setUsers] = useState([]);
  const [search, setSearch] = useState('');

  useEffect(() => {
    fetchUsers();
  }, []);

  const fetchUsers = async () => {
    try {
      const response = await axios.get('/admin/dashboard');
      setUsers(response.data);
    } catch (error) {
      console.error('Fehler beim Laden der Benutzer:', error);
    }
  };

  const handleSearch = async (event) => {
    event.preventDefault();
    try {
      const response = await axios.get(`/admin/search?search=${encodeURIComponent(search)}`);
      setUsers(response.data);
    } catch (error) {
      console.error('Fehler beim Suchen von Benutzern:', error);
    }
  };

  return (
 
    <div className="base-color-light app-layout">
    <div className="py-4 min-h-screen">
      <div className="max-w-md mx-auto px-4">
        <div className="light:base-color-light">
          <div className="px-4 sm:px-6">
            <h3 className="h3-text">Benutzerverwaltung</h3>
          </div>

          <form onSubmit={handleSearch} className="flex justify-center pt-5 px-5">
            <input
              type="text"
              name="search"
              placeholder="Benutzer suchen..."
              className="form-control w-full px-5 h-12 text-xl"
              value={search}
              onChange={(e) => setSearch(e.target.value)}
            />
            <button type="submit" className="ml-2 px-5">
              Suchen
            </button>
          </form>

          <div className="mb-6"></div>
        </div>

        <div className="border-t">
          {users.map((user) => (
            <div key={user.id} className="w-full flex items-center justify-between px-4 py-2 text-left content-text hover:accent-color">
              <span>{user.name}</span>
              <Link to={`/admin/users/${user.id}`} className="iconNext h-6 w-6">Bearbeiten</Link>
            </div>
          ))}
        </div>
      </div>
    </div>
    </div>
 
  );
};

export default AdminDashboard;
