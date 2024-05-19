import React from 'react';
import { useForm } from 'react-hook-form';
import axios, { getCsrfToken } from '../../Components/auth/axios';
import { useNavigate } from 'react-router-dom';
import '../../index.css';

const Register = ({ login }) => {
  const { register, handleSubmit, formState: { errors } } = useForm();
  const navigate = useNavigate();

  const onSubmit = async (data) => {
    try {
      await getCsrfToken(); // CSRF-Token holen
      const response = await axios.post('/register', data);
      console.log('Registrierung erfolgreich:', response.data);
      await login(data);
      navigate('/'); // Zur Startseite umleiten
    } catch (error) {
      console.error('Registration error:', error);
      // handle registration errors
    }
  };

  return (
    <div className="base-color-light min-h-screen flex items-center justify-center">
      <div className="px-5 py-12">
        <div className="text-center mb-10">
          <h1 className="h1-text font-bold">Register</h1>
        </div>

        <form onSubmit={handleSubmit(onSubmit)} className="space-y-6">
          <div>
            <label htmlFor="name" className="block content-text font-bold mb-2">Name:</label>
            <input
              id="name"
              type="text"
              {...register('name', { required: true })}
              className="block w-full p-5 h-10 content-text light-color mb-5"
              required
            />
            {errors.name && <span className="text-red-500">Name is required</span>}
          </div>

          <div>
            <label htmlFor="surname" className="block content-text font-bold mb-2">Surname:</label>
            <input
              id="surname"
              type="text"
              {...register('surname', { required: true })}
              className="block w-full p-5 h-10 content-text light-color mb-5"
              required
            />
            {errors.surname && <span className="text-red-500">Surname is required</span>}
          </div>

          <div>
            <label htmlFor="email" className="block content-text font-bold mb-2">Email:</label>
            <input
              id="email"
              type="email"
              {...register('email', { required: true })}
              className="block w-full p-5 h-10 content-text light-color mb-5"
              required
            />
            {errors.email && <span className="text-red-500">Email is required</span>}
          </div>

          <div>
            <label htmlFor="password" className="block content-text font-bold mb-2">Password:</label>
            <input
              id="password"
              type="password"
              {...register('password', { required: true })}
              className="block w-full p-5 h-10 content-text light-color mb-5"
              required
            />
            {errors.password && <span className="text-red-500">Password is required</span>}
          </div>

          <div>
            <label htmlFor="password_confirmation" className="block content-text font-bold mb-2">Confirm Password:</label>
            <input
              id="password_confirmation"
              type="password"
              {...register('password_confirmation', { required: true })}
              className="block w-full p-5 h-10 content-text light-color mb-5"
              required
            />
            {errors.password_confirmation && <span className="text-red-500">Password confirmation is required</span>}
          </div>

          <div className="flex justify-end">
            <button type="submit" className="content-text py-2 px-4 br-buttons light-color">Register</button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default Register;
