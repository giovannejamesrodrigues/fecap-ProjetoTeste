import axios from "axios";

const baseUrl = 'http://127.0.0.1:40001/api/v1';

function getOptions() {
    return {
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }
}

async function listTasks() {
    try {
        const response = await axios.get(`${baseUrl}/tasks`, getOptions());

        if(!response.data.success) {
            throw new Error(response.data.message);
        }

        return response.data.tasks;
    } catch (error) {
        if(error.response.data) {
            throw new Error(error.response.data.message);
        }
        throw error;
    }
}

async function addTask(description) {
    try {
        const response = await axios.post(`${baseUrl}/tasks`, {
            description
        }, getOptions());

        if(!response.data.success) {
            throw new Error(response.data.message);
        }

        return true;
    } catch (error) {
        if(error.response.data) {
            throw new Error(error.response.data.message);
        }
        throw error;
    }
}

async function deleteTask(id) {
    try {
        const response = await axios.delete(`${baseUrl}/tasks/${id}`, getOptions());

        if(!response.data.success) {
            throw new Error(response.data.message);
        }

        return true;
    } catch (error) {
        if(error.response.data) {
            throw new Error(error.response.data.message);
        }
        throw error;
    }
}

async function updateTask(id, description) {
    try {
        const response = await axios.put(`${baseUrl}/tasks/${id}`, {
            description
        }, getOptions());

        if(!response.data.success) {
            throw new Error(response.data.message);
        }

        return true;
    } catch (error) {
        if(error.response.data) {
            throw new Error(error.response.data.message);
        }
        throw error;
    }
}

async function completeTask(id) {
    try {
        const response = await axios.post(`${baseUrl}/tasks/${id}/complete`, {}, getOptions());

        if(!response.data.success) {
            throw new Error(response.data.message);
        }

        return true;
    } catch (error) {
        if(error.response.data) {
            throw new Error(error.response.data.message);
        }
        throw error;
    }
}

export { listTasks, addTask, deleteTask, updateTask, completeTask };