import React from 'react';
import { useForm } from 'react-hook-form';
import { useNavigate } from 'react-router-dom';

const Login = ({ login }) => {
  const { register, handleSubmit, formState: { errors } } = useForm();
  const navigate = useNavigate();

  const onSubmit = async data => {
    try {
      await login(data);
      navigate('/'); // Zur Startseite umleiten
    } catch (error) {
      console.error('Login error:', error);
      // handle login errors
    }
  };

  return (
    <div className="guest-layout">
      <div className="text-center mb-10">
        <h1 className="text-xl font-bold">Login</h1>
      </div>

      <form onSubmit={handleSubmit(onSubmit)}>
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

        <button type="submit">Login</button>
      </form>
    </div>
  );
};

export default Login;
