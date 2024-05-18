import Axios from 'axios';
import API_BASE_URL from './config';

const axios = Axios.create({
    baseURL: API_BASE_URL,
    withXSRFToken: true,
    withCredentials: true,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});

export const getCsrfToken = async () => {
    await axios.get('/sanctum/csrf-cookie');
    const csrfToken = document.cookie.split('; ').find(row => row.startsWith('XSRF-TOKEN')).split('=')[1];
    axios.defaults.headers.common['X-XSRF-TOKEN'] = csrfToken;
};

export default axios;
