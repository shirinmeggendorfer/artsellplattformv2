import React from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import '../../index.css';

const VerifyEmail = () => {
  const navigate = useNavigate();
  const resendVerificationEmail = async () => {
    try {
      await axios.post('/verification/send');
      // handle success
    } catch (error) {
      console.error('Resend verification email error:', error);
      // handle errors
    }
  };

  const logout = async () => {
    try {
      await axios.post('/logout');
      navigate('/login'); // Redirect to login page
    } catch (error) {
      console.error('Logout error:', error);
      // handle errors
    }
  };

  return (
    <div className="base-color-light min-h-screen flex items-center justify-center">
      <div className="px-5 py-12">
        <div className="mb-4 content-text text-gray-600 dark:text-gray-400">
          Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        {sessionStorage.getItem('status') === 'verification-link-sent' && (
          <div className="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            A new verification link has been sent to the email address you provided during registration.
          </div>
        )}

        <div className="mt-4 flex items-center justify-between">
          <button onClick={resendVerificationEmail} className="content-text py-2 px-4 br-buttons light-color">
            Resend Verification Email
          </button>

          <button onClick={logout} className="content-text py-2 px-4 br-buttons light-color underline">
            Log Out
          </button>
        </div>
      </div>
    </div>
  );
};

export default VerifyEmail;
