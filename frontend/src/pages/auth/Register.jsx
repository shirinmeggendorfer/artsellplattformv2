import React from 'react';
import { useForm } from 'react-hook-form';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

const Register = ({ login }) => {
  const { register, handleSubmit, formState: { errors } } = useForm();
  const navigate = useNavigate();

  const onSubmit = async data => {
    try {
      await axios.get('http://localhost:8000/sanctum/csrf-cookie', { withCredentials: true });
      await axios.post('http://localhost:8000/api/register', data, {
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        withCredentials: true,
      });
      await login(data);
      navigate('/'); // Zur Startseite umleiten
    } catch (error) {
      console.error('Registration error:', error);
      // handle registration errors
    }
  };

  return (
    <div className="guest-layout">
      <div className="text-center mb-10">
        <h1 className="text-xl font-bold">Register</h1>
      </div>

      <form onSubmit={handleSubmit(onSubmit)}>
        <div>
          <label htmlFor="name">Name</label>
          <input id="name" type="text" {...register('name', { required: true })} />
          {errors.name && <span>Name is required</span>}
        </div>

        <div>
          <label htmlFor="surname">Nachname</label>
          <input id="surname" type="text" {...register('surname', { required: true })} />
          {errors.surname && <span>Surname is required</span>}
        </div>

        <div>
          <label htmlFor="email">Email</label>
          <input id="email" type="email" {...register('email', { required: true })} />
          {errors.email && <span>Email is required</span>}
        </div>

        <div>
          <label htmlFor="password">Password</label>
          <input id="password" type="password" {...register('password', { required: true })} />
          {errors.password && <span>Password is required</span>}
        </div>

        <div>
          <label htmlFor="password_confirmation">Confirm Password</label>
          <input id="password_confirmation" type="password" {...register('password_confirmation', { required: true })} />
          {errors.password_confirmation && <span>Password confirmation is required</span>}
        </div>

        <button type="submit">Register</button>
      </form>
    </div>
  );
};

export default Register;
