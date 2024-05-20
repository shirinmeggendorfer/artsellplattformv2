import React, { useState } from 'react';
import { useForm } from 'react-hook-form';
import { useNavigate, Link } from 'react-router-dom';
import '../../index.css';

const Login = ({ login }) => {
  const { register, handleSubmit, formState: { errors } } = useForm();
  const navigate = useNavigate();
  const [errorMessage, setErrorMessage] = useState('');

  const onSubmit = async data => {
    try {
      await login(data);
      navigate('/'); // Zur Startseite umleiten bei erfolgreichem Login
    } catch (error) {
      console.error('Login error:', error);
      setErrorMessage('Login war nicht erfolgreich. Bitte überprüfen Sie Ihre Anmeldedaten.');
    }
  };

  return (
    <div className="base-color-light min-h-screen flex items-center justify-center">
      <div className="px-5 py-12">
        <div className="text-center mb-10">
          <h1 className="h1-text font-bold">Login</h1>
        </div>

        {errorMessage && (
          <div className="mb-4 p-4 text-red-700 bg-red-100 rounded">
            {errorMessage}
          </div>
        )}

        <form onSubmit={handleSubmit(onSubmit)} className="space-y-6">
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

          <div className="flex justify-end">
            <button type="submit" className="content-text py-2 px-4 br-buttons light-color">Login</button>
          </div>
        </form>

        <div className="mt-2 text-center">
          <span className="content-text">Not registered yet? </span>
          <Link to="/register" className="text-blue-500 underline">Register here</Link>
        </div>
      </div>
    </div>
  );
};

export default Login;
