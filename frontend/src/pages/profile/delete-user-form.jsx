/*
import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

const DeleteUserForm = () => {
  const [showDeleteModal, setShowDeleteModal] = useState(false);
  const navigate = useNavigate();

  const handleDelete = async () => {
    if (window.confirm('Sind Sie sicher, dass Sie Ihr Profil löschen möchten?')) {
      try {
        const userResponse = await axios.get('/api/user', {
          withCredentials: true,
        });
        const userId = userResponse.data.id;

        await axios.delete(`/users/${userId}`, {
          withCredentials: true,
        });

        navigate('/');
      } catch (error) {
        console.error('Fehler beim Löschen des Benutzers:', error);
        alert('Fehler beim Löschen des Profils. Bitte versuchen Sie es erneut.');
      }
    }
  };

  return (
    <section className="space-y-6">
      <header>
        <h2 className="h2-text">Delete Account</h2>
        <p className="mt-1 content-text">
          Sobald Ihr Konto gelöscht ist, werden alle Ressourcen und Daten dauerhaft gelöscht. Bitte laden Sie alle Daten oder Informationen herunter, die Sie behalten möchten, bevor Sie fortfahren.
        </p>
      </header>
      <button
        className="button content-text py-2 px-4 br-buttons light-color"
        onClick={() => setShowDeleteModal(true)}
      >
        Profil löschen
      </button>
      {showDeleteModal && (
        <div className="x-modal">
          <div className="p-6">
            <h2 className="content-text">Möchten Sie wirklich Ihr Profil löschen?</h2>
            <p className="mt-1 content-text">
              Sobald Ihr Konto gelöscht ist, werden alle Ressourcen und Daten dauerhaft gelöscht. Diese Aktion kann nicht rückgängig gemacht werden.
            </p>
            <div className="mt-6 flex justify-end">
              <button
                type="button"
                className="button content-text py-2 px-4 br-buttons light-color"
                onClick={() => setShowDeleteModal(false)}
              >
                Abbrechen
              </button>
              <button
                type="button"
                onClick={handleDelete}
                className="button content-text py-2 px-4 br-buttons light-color"
              >
                Profil löschen
              </button>
            </div>
          </div>
        </div>
      )}
    </section>
  );
};

export default DeleteUserForm;
*/