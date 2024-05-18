import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { confirmAlert } from 'react-confirm-alert';
import 'react-confirm-alert/src/react-confirm-alert.css';
import DeleteUserForm from './delete-user-form';
import UpdatePasswordForm from './update-password-form';
import UpdateProfileInformationForm from './update-profile-information-form';

const EditProfile = ({ isAuthenticated, user, logout }) => {
  const [items, setItems] = useState([]);
  const [profileImage, setProfileImage] = useState(user ? user.profile_image : 'profilepictures/user-2.png');
  const [error, setError] = useState(null);

  useEffect(() => {
    if (isAuthenticated) {
      axios.get('/api/profile')
        .then(response => {
          setItems(response.data.items);
          setProfileImage(response.data.user.profile_image || 'profilepictures/user-2.png');
        })
        .catch(error => {
          setError(error.response ? error.response.data.error : 'Error loading user data');
        });
    }
  }, [isAuthenticated]);

  const handleImageChange = async (e) => {
    const formData = new FormData();
    formData.append('profile_image', e.target.files[0]);

    try {
      const response = await axios.post('/api/profile/picture', formData, {
        headers: { 'Content-Type': 'multipart/form-data' },
      });
      setProfileImage(response.data.profile_image);
    } catch (error) {
      console.error("Error updating profile picture", error);
    }
  };

  const confirmDelete = (itemId) => {
    confirmAlert({
      title: 'Bestätigung erforderlich',
      message: 'Sind Sie sicher, dass Sie diesen Artikel löschen möchten?',
      buttons: [
        {
          label: 'Ja',
          onClick: () => handleDelete(itemId)
        },
        {
          label: 'Nein',
          onClick: () => {}
        }
      ]
    });
  };

  const handleDelete = async (itemId) => {
    try {
      await axios.delete(`/api/profile/item/${itemId}`);
      setItems(items.filter(item => item.id !== itemId));
    } catch (error) {
      console.error("Error deleting item", error);
    }
  };

  if (!user && !error) {
    return <div>Loading...</div>;
  }

  if (error) {
    return <div>{error}</div>;
  }

  return (
    <div className="py-4">
      <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div className="mt-4 px-5 flex items-center">
          <label className="x-label">Aktuelles Bild</label>
          <img src={`/storage/${profileImage}`} alt="Aktuelles Bild" className="br-profile-picture profile-image ml-2" />
          <div className="flex flex-col px-5 ml-2">
            <span className="content-text py-5">Hallo, {user.name}</span>
            <form id="uploadForm" method="POST" encType="multipart/form-data">
              <input type="file" id="profile_image_input" name="profile_image" className="hidden" onChange={handleImageChange} />
              <button type="button" onClick={() => document.getElementById('profile_image_input').click()} className="x-button">
                Bild ändern
              </button>
            </form>
          </div>
        </div>

        <div className="py-4">
          <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div>
              <button className="w-full flex items-center justify-between px-4 py-2 text-left h3-text light-color hover:accent-colour rounded-md">
                <span>Profileinstellungen</span>
              </button>
              <div className="p-4 mt-2 light:base-color-light rounded-lg">
                <UpdateProfileInformationForm user={user} />
                <UpdatePasswordForm />
                <DeleteUserForm />
              </div>
            </div>
          </div>
        </div>

        <div>
          <button className="w-full flex items-center justify-between px-4 py-2 text-left h3-text light-color hover:accent-colour rounded-md">
            <span>Meine Anzeigen</span>
          </button>
          <div className="py-2 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            {items.length > 0 ? (
              items.map((item) => (
                <div key={item.id} className="light-color rounded-lg overflow-hidden shadow">
                  <img src={`/storage/photos/${item.photo}`} alt={item.title} className="w-full h-20 object-cover" />
                  <div className="p-2">
                    <h5 className="h3-text text-center">{item.title}</h5>
                    <div className="mt-2">
                      <a href={`/items/${item.id}/edit`} className="btn btn-primary justify-center content-text-small w-full mb-2">Bearbeiten</a>
                      <button type="button" onClick={() => confirmDelete(item.id)} className="justify-center content-text-small btn btn-danger w-full">Löschen</button>
                    </div>
                  </div>
                </div>
              ))
            ) : (
              <p>Keine Anzeigen gefunden.</p>
            )}
          </div>
        </div>

        <div className="p-4 sm:p-8 light:base-color-light">
          <div className="max-w-xl">
            <button onClick={logout} className="x-button">Logout</button>
          </div>
          <div className="mb-20"></div>
        </div>
      </div>
    </div>
  );
};

export default EditProfile;
