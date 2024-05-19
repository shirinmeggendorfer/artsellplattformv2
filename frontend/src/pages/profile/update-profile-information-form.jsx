import React from 'react';
import axios from 'axios';

const UpdateProfileInformationForm = ({ user }) => {
  const handleFormSubmit = async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);

    try {
      await axios.post('/profile', formData, {
        headers: {
          'Content-Type': 'application/json',
        },
      });
      // Handle success
    } catch (error) {
      // Handle error
    }
  };

  return (
    <section>
      <header>
        <h2 className="h2-text">
          Profil Informationen
        </h2>

        <p className="mt-1 content-text">
          Aktualisieren Sie die Profilinformationen und die E-Mail-Adresse Ihres Kontos.
        </p>
      </header>

      <form onSubmit={handleFormSubmit} className="mt-6 space-y-6">
        <div>
          <label htmlFor="name" className=" content-text  ">Name</label>
          <div className="mb-2"></div>
          <input
            id="name"
            name="name"
            type="text"
            className="block w-full p-5 h-10 content-text light-color mb-5"
            defaultValue={user.name}
            required
            autoFocus
            autoComplete="name"
          />
        </div>

        <div>
          <label htmlFor="surname" className=" content-text ">Nachname</label>
          <div className="mb-2"></div>
          <input
            id="surname"
            name="surname"
            type="text"
            className="block w-full p-5 h-10 content-text light-color mb-5"
            defaultValue={user.surname}
            required
            autoFocus
            autoComplete="surname"
          />
        </div>

        <div>
          <label htmlFor="email" className=" conten-text">Email</label>
          <div className="mb-2"></div>
          <input
            id="email"
            name="email"
            type="email"
            className="block w-full p-5 h-10 content-text light-color mb-5"
            defaultValue={user.email}
            required
            autoComplete="username"
          />
        </div>

        <div className="flex items-center gap-4">
          <button type="submit" className="button content-text py-2 px-4 br-buttons light-color">Speichern</button>
          <div className="py-12"></div>
        </div>
      </form>
    </section>
  );
};

export default UpdateProfileInformationForm;
