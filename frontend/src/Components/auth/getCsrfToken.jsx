import axios from 'axios';

axios.defaults.withCredentials = true;

const getCsrfToken = async () => {
    try {
        await axios.get('http://localhost:8000/sanctum/csrf-cookie');
        const csrfToken = document.cookie
            .split('; ')
            .find(row => row.startsWith('XSRF-TOKEN'))
            ?.split('=')[1];
        if (csrfToken) {
            axios.defaults.headers.common['X-XSRF-TOKEN'] = csrfToken;
        } else {
            console.error('CSRF token not found');
        }
    } catch (error) {
        console.error('Failed to get CSRF token', error);
    }
};

export default getCsrfToken;
