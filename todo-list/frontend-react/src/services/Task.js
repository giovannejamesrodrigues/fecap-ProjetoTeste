import axios from "axios";

const baseUrl = 'http://127.0.0.1:40001/api/v1';
const headers = {
    headers: {
        'Authorization': localStorage.getItem('token')
    }
};

async function listTasks() {
    try {
        const response = await axios.get(`${baseUrl}/tasks`, {
            headers: {
                'Authorization': localStorage.getItem('token')
            }
        });

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
        }, headers);

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
        const response = await axios.delete(`${baseUrl}/tasks/${id}`, headers);

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
        }, headers);

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
        const response = await axios.post(`${baseUrl}/tasks/${id}/complete`, {}, headers);

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