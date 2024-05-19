import React, { useState } from 'react';
import axios from 'axios';

const DeleteUserForm = () => {
  const [password, setPassword] = useState('');
  const [showDeleteModal, setShowDeleteModal] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await axios.delete('/profileDestroy', {
        data: { password },
      });
      // Handle success
    } catch (error) {
      // Handle error
    }
  };

  return (
    <section className="space-y-6">
      <header>
        <h2 className="h2-text">Delete Account</h2>
        <p className="mt-1 content-text">
          Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
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
          <form onSubmit={handleSubmit} className="p-6">
            <h2 className="content-text">Möchtest du wirklich dein Profil löschen?</h2>
            <p className="mt-1 content-text">
              Sobald Ihr Konto gelöscht ist, werden alle Ressourcen und Daten dauerhaft gelöscht. Bitte geben Sie Ihr Passwort ein, um zu bestätigen, dass Sie Ihr Konto endgültig löschen möchten.
            </p>
            <div className="mt-6">
              <label htmlFor="password" className="sr-only">Password</label>
              <input
                id="password"
                name="password"
                type="password"
                className="block w-full p-5 h-10 content-text light-color mb-5"
                placeholder="Password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                required
              />
            </div>
            <div className="mt-6 flex justify-end">
              <button
                type="button"
                className="button content-text py-2 px-4 br-buttons light-color"
                onClick={() => setShowDeleteModal(false)}
              >
                Abbrechen
              </button>
              <button type="submit" className="button content-text py-2 px-4 br-buttons light-color">
                Profil löschen
              </button>
            </div>
          </form>
        </div>
      )}
    </section>
  );
};

export default DeleteUserForm;
