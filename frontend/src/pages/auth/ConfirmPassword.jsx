import React from 'react';
import { useForm } from 'react-hook-form';
import '../../index.css';

const ConfirmPassword = ({ confirmPassword }) => {
  const { register, handleSubmit, formState: { errors } } = useForm();

  const onSubmit = async data => {
    try {
      await confirmPassword(data);
      // handle success
    } catch (error) {
      console.error('Confirm password error:', error);
      // handle errors
    }
  };

  return (
    <div className="base-color-light min-h-screen flex items-center justify-center">
      <div className="px-5 py-12">
        <div className="mb-4 content-text text-gray-600 dark:text-gray-400">
          This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <form onSubmit={handleSubmit(onSubmit)} className="space-y-6">
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

          <div className="flex justify-end">
            <button type="submit" className="content-text py-2 px-4 br-buttons light-color">Confirm</button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default ConfirmPassword;
