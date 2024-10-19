const DATA_SERVER_URL = 'http://todo-php/todo.php';

import express from 'express';
import fetch from 'node-fetch';
import cors from 'cors'

const app = express();
app.use(cors());
app.use(express.json());

const apiRouter = express.Router();

apiRouter.post('/login', async (req, res) => {
    try {
        const response = await fetch(`${DATA_SERVER_URL}/login`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                login: req.body.login,
                senha: req.body.password,
            }),
        }).then(response => response.json());
        if(response.code != 200) {
            if(response.code) {
                res.status(response.code).json({
                    success: false,
                    message: response.message,
                });
                return;
            }
        }


        res.json({
            success: true,
            message: 'Login efetuado com sucesso',
            token: response.data.token,
        });
    } catch (error) {
        res.status(500).json({
            success: false,
            message: 'Erro durante o login',
            error: error.message,
        });
    }
});

apiRouter.post('/register', async (req, res) => {
    try {
        const response = await fetch(`${DATA_SERVER_URL}/register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                login: req.body.login,
                senha: req.body.password,
            }),
        }).then(response => response.json());
        if(response.code != 200) {
            if(response.code) {
                res.status(response.code).json({
                    success: false,
                    message: response.message,
                });
                return;
            }
        }

        res.json({
            success: true,
            message: 'Usuário cadastrado com sucesso',
            token: response.data.token,
        });
    } catch (error) {
        res.status(500).json({
            success: false,
            message: 'Erro durante o cadastro',
            error: error.message,
        });
    }
});

apiRouter.get('/tasks', async (req, res) => {
    try {
        const response = await fetch(`${DATA_SERVER_URL}/tasks`, {
            headers: {
                'jwt-token': req.headers.authorization,
            },
        }).then(response => response.json());
        if(response.code != 200) {
            if(response.code) {
                res.status(response.code).json({
                    success: false,
                    message: response.message,
                });
                return;
            }
        }

        res.json({
            success: true,
            message: 'Tarefas retornadas com sucesso',
            tasks: response.data,
        });
    } catch (error) {
        res.status(500).json({
            success: false,
            message: 'Erro durante a busca das tarefas',
            error: error.message,
        });
    }
});

apiRouter.post('/tasks', async (req, res) => {
    try {
        const response = await fetch(`${DATA_SERVER_URL}/task`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'jwt-token': req.headers.authorization,
            },
            body: new URLSearchParams({
                descricao: req.body.description,
            }),
        }).then(response => response.json());
        if(response.code != 200) {
            if(response.code) {
                res.status(response.code).json({
                    success: false,
                    message: response.message,
                });
                return;
            }
        }

        res.json({
            success: true,
            message: 'Tarefa cadastrada com sucesso',
        });
    } catch (error) {
        res.status(500).json({
            success: false,
            message: 'Erro durante o cadastro da tarefa',
            error: error.message,
        });
    }
});

apiRouter.get('/tasks/:id', async (req, res) => {
    try {
        const response = await fetch(`${DATA_SERVER_URL}/task/get?id=${req.params.id}`, {
            headers: {
                'jwt-token': req.headers.authorization,
            },
        }).then(response => response.json());
        if(response.code != 200) {
            if(response.code) {
                res.status(response.code).json({
                    success: false,
                    message: response.message,
                });
                return;
            }
        }

        res.json({
            success: true,
            message: 'Tarefa retornada com sucesso',
            task: response.data,
        });
    } catch (error) {
        res.status(500).json({
            success: false,
            message: 'Erro durante a busca da tarefa',
            error: error.message,
        });
    }
});

apiRouter.put('/tasks/:id', async (req, res) => {
    try {
        const response = await fetch(`${DATA_SERVER_URL}/task/editar`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'jwt-token': req.headers.authorization,
            },
            body: new URLSearchParams({
                id: req.params.id,
                descricao: req.body.description,
            }),
        }).then(response => response.json());
        if(response.code != 200) {
            if(response.code) {
                res.status(response.code).json({
                    success: false,
                    message: response.message,
                });
                return;
            }
        }

        res.json({
            success: true,
            message: 'Tarefa atualizada com sucesso',
        });
    } catch (error) {
        res.status(500).json({
            success: false,
            message: 'Erro durante a atualização da tarefa',
            error: error.message,
        });
    }
});

apiRouter.delete('/tasks/:id', async (req, res) => {
    try {
        const response = await fetch(`${DATA_SERVER_URL}/task/deletar`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'jwt-token': req.headers.authorization,
            },
            body: new URLSearchParams({
                id: req.params.id,
            }),
        }).then(response => response.json());
        if(response.code != 200) {
            if(response.code) {
                res.status(response.code).json({
                    success: false,
                    message: response.message,
                });
                return;
            }
        }

        res.json({
            success: true,
            message: 'Tarefa deletada com sucesso',
        });
    } catch (error) {
        res.status(500).json({
            success: false,
            message: 'Erro durante a deleção da tarefa',
            error: error.message,
        });
    }
});

apiRouter.post('/tasks/:id/complete', async (req, res) => {
    try {
        const response = await fetch(`${DATA_SERVER_URL}/task/concluir`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'jwt-token': req.headers.authorization,
            },
            body: new URLSearchParams({
                id: req.params.id,
            }),
        }).then(response => response.json());
        if(response.code != 200) {
            if(response.code) {
                res.status(response.code).json({
                    success: false,
                    message: response.message,
                });
                return;
            }
        }

        res.json({
            success: true,
            message: 'Tarefa concluída com sucesso',
        });
    } catch (error) {
        res.status(500).json({
            success: false,
            message: 'Erro durante a conclusão da tarefa',
            error: error.message,
        });
    }
});

app.use('/api/v1', apiRouter);

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Servidor rodando na porta ${PORT}`);
});