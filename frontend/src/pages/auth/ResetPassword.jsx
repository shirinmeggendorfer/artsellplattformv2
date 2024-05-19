import React from 'react';
import { useForm } from 'react-hook-form';
import '../../index.css';

const ResetPassword = ({ resetPassword, token }) => {
  const { register, handleSubmit, formState: { errors } } = useForm();

  const onSubmit = async data => {
    try {
      await resetPassword({ ...data, token });
      // handle success
    } catch (error) {
      console.error('Reset password error:', error);
      // handle errors
    }
  };

  return (
    <div className="base-color-light min-h-screen flex items-center justify-center">
      <div className="px-5 py-12">
        <form onSubmit={handleSubmit(onSubmit)} className="space-y-6">
          <input type="hidden" name="token" value={token} />

          <div>
            <label htmlFor="email" className="block content-text font-bold mb-2">Email:</label>
            <input
              id="email"
              type="email"
              {...register('email', { required: true })}
              className="block w-full p-5 h-10 h2-text light-color mb-5"
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
              className="block w-full p-5 h-10 h2-text light-color mb-5"
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
              className="block w-full p-5 h-10 h2-text light-color mb-5"
              required
            />
            {errors.password_confirmation && <span className="text-red-500">Password confirmation is required</span>}
          </div>

          <div className="flex justify-end">
            <button type="submit" className="content-text py-2 px-4 br-buttons light-color">Reset Password</button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default ResetPassword;
