import React from 'react';
import { Navigate } from 'react-router-dom';

const PrivateRoute = ({ isAuthenticated, user, requiredRole, element: Component }) => {
  if (!isAuthenticated) {
    return <Navigate to="/login" />;
  }

  if (requiredRole && user) {
    if (requiredRole === 'admin' && !user.is_admin) {
      return <Navigate to="/" />;
    }
  }

  return Component;
};

export default PrivateRoute;
