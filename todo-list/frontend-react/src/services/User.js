import axios from "axios";

const baseUrl = 'http://127.0.0.1:40001/api/v1';

async function login(username, password) {
    try {
        const response = await axios.post(`${baseUrl}/login`, {
            login: username,
            password: password
        });

        if(!response.data.success) {
            throw new Error(response.data.message);
        }

        localStorage.setItem('token', response.data.token);

        return true;
    } catch (error) {
        if(error.response.data) {
            throw new Error(error.response.data.message);
        }
        throw error;
    }
}

async function register(username, password) {
    try {
        const response = await axios.post(`${baseUrl}/register`, {
            login: username,
            password: password
        });

        if(!response.data.success) {
            throw new Error(response.data.message);
        }

        localStorage.setItem('token', response.data.token);

        return true;
    } catch (error) {
        if(error.response.data) {
            throw new Error(error.response.data.message);
        }
        throw error;
    }
}

function logout() {
    localStorage.removeItem('token');
}

export { login, logout, register };