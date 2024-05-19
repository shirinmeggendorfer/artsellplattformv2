import React from 'react';
import { useForm } from 'react-hook-form';
import '../../index.css';

const ForgotPassword = ({ sendPasswordResetEmail }) => {
  const { register, handleSubmit, formState: { errors } } = useForm();

  const onSubmit = async data => {
    try {
      await sendPasswordResetEmail(data);
      // handle success
    } catch (error) {
      console.error('Password reset email error:', error);
      // handle errors
    }
  };

  return (
    <div className="base-color-light min-h-screen flex items-center justify-center">
      <div className="px-5 py-12">
        <div className="mb-4 content-text-small">
          Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <form onSubmit={handleSubmit(onSubmit)} className="space-y-6">
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

          <div className="flex justify-end">
            <button type="submit" className="content-text py-2 px-4 br-buttons light-color">Email Password Reset Link</button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default ForgotPassword;
