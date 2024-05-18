import axios from 'axios';

axios.defaults.withCredentials = true;

const getCsrfToken = async () => {
  await axios.get('http://localhost:8000/sanctum/csrf-cookie');
  const csrfToken = document.cookie.split('; ').find(row => row.startsWith('XSRF-TOKEN')).split('=')[1];
  axios.defaults.headers.common['X-XSRF-TOKEN'] = csrfToken;
};

export default getCsrfToken;
