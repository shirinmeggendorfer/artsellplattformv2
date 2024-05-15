import React from 'react';
import ReactDOM from 'react-dom';
import './index.css'; // Importieren Sie Ihr CSS hier
import App from './App';
import reportWebVitals from './reportWebVitals';

ReactDOM.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>,
  document.getElementById('root')
);

// Sie können den Bericht über Web-Vitals unten entfernen, wenn Sie ihn nicht benötigen
reportWebVitals();
