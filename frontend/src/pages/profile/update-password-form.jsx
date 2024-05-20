import React, { useState } from 'react';
import axios from 'axios';

const UpdatePasswordForm = () => {
  const [currentPassword, setCurrentPassword] = useState('');
  const [newPassword, setNewPassword] = useState('');
  const [passwordConfirmation, setPasswordConfirmation] = useState('');
  const [errors, setErrors] = useState([]);
  const [status, setStatus] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await axios.put('/api/password/update', {
        current_password: currentPassword,
        password: newPassword,
        password_confirmation: passwordConfirmation,
      });
      setStatus('password-updated');
    } catch (error) {
      setErrors(error.response.data.errors || []);
    }
  };

  return (
    <section>
      <header>
        <h2 className="h2-text">Passtwort ändern</h2>
        <p className="mt-1 content-text">
          Stellen Sie sicher, dass Ihr Konto ein langes, zufälliges Passwort verwendet, um sicher zu sein.
        </p>
      </header>

      <form onSubmit={handleSubmit} className="mt-6 space-y-6">
        <div>
          <label htmlFor="update_password_current_password" className="x-input-label content-text">Current Password</label>
          <input
            id="update_password_current_password"
            name="current_password"
            type="password"
            className="block w-full p-5 h-10 content-text light-color mb-5"
            value={currentPassword}
            onChange={(e) => setCurrentPassword(e.target.value)}
            autoComplete="current-password"
          />
          {errors.current_password && <div className="mt-2 x-input-error content-text">{errors.current_password}</div>}
        </div>

        <div>
          <label htmlFor="update_password_password" className="x-input-label content-text">New Password</label>
          <input
            id="update_password_password"
            name="password"
            type="password"
            className="block w-full p-5 h-10 content-text light-color mb-5"
            value={newPassword}
            onChange={(e) => setNewPassword(e.target.value)}
            autoComplete="new-password"
          />
          {errors.password && <div className="mt-2 x-input-error content-text">{errors.password}</div>}
        </div>

        <div>
          <label htmlFor="update_password_password_confirmation" className="input-label content-text">Confirm Password</label>
          <input
            id="update_password_password_confirmation"
            name="password_confirmation"
            type="password"
            className="block w-full p-5 h-10 content-text light-color mb-5"
            value={passwordConfirmation}
            onChange={(e) => setPasswordConfirmation(e.target.value)}
            autoComplete="new-password"
          />
          {errors.password_confirmation && <div className="mt-2 x-input-error">{errors.password_confirmation}</div>}
        </div>

        <div className="flex items-center gap-4">
          <button type="submit" className="button content-text py-2 px-4 br-buttons light-color">Speichern</button>
          {status === 'password-updated' && (
            <p className="text-sm text-gray-600 ">Speichern.</p>
          )}
        </div>
      </form>
      <div className="py-12"></div>
    </section>
  );
};

export default UpdatePasswordForm;
