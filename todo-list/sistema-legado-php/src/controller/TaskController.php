<?php declare(strict_types=1);
namespace Controller;

use Attributes\Request;
use \Exceptions\JsonException;
use Model\Task;
use Model\User;

class TaskController extends Controller {

    private User $userModel;
    private Task $taskModel;

    private object $user;
    protected function middleware() {
        if(!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            throw new JsonException('Token não informado', 403);
        }
        $this->user = $this->userModel->loginJwt($_SERVER['HTTP_AUTHORIZATION']);
        $this->taskModel->setUser($this->user);
    }

    #[Request('/task', method: 'POST')]
    public function criarTask(array $data): object {
        return $this->taskModel->create($data['descricao']);
    }

    #[Request('/tasks', method: 'GET')]
    public function listarTasks(array $data): array {
        return $this->taskModel->list();
    }

    #[Request('/task/get', method: 'GET')]
    public function lerTask(array $data): object {
        return $this->taskModel->get((int)$data['id']);
    }

    #[Request('/task/editar', method: 'POST')]
    public function editarTask(array $data): object {
        return $this->taskModel->update($data['id'], $data['descricao']);
    }

    #[Request('/task/concluir', method: 'POST')]
    public function concluirTask(array $data): object {
        return $this->taskModel->setComplete((int)$data['id']);
    }

    #[Request('/task/deletar', method: 'POST')]
    public function deletarTask(array $data): null {
        return $this->taskModel->delete((int)$data['id']);
    }

    /** INÍCIO DOS MÉTODOS DE TESTE */
    #[Request('/view/tasks', method: 'GET')]
    public function listarTasks_form(array $data): string {
        $tasks = $this->taskModel->list();
        $html = '<h1>Tasks</h1>';
        $html.= '<a href="task/criar">Criar</a>';
        $html.= '<hr>';
        $html.= '<ul>';
        foreach($tasks as $task) {
            $html .= '<li>' . $task->description . ' - '. ($task->done ? 'Concluído' : 'Pendente') . ' - <a href="task?id=' . $task->id . '">Ver</a></li>';
        }
        $html .= '</ul>';
        return $html;
    }

    #[Request('/view/task', method: 'GET')]
    public function lerTask_form(array $data): string {
        $task = $this->taskModel->get((int)$data['id']);
        $html = '<h1>Task</h1>';
        $html .= '<h2>' . $task->description . '</h2>';
        $html .= '<p>' . ($task->done ? 'Concluído' : 'Pendente') . '</p>';
        $html .= '<a href="task/editar?id=' . $task->id . '"><button>Editar</button></a>';
        $html .= '<a href="task/concluir?id=' . $task->id . '"><button>Concluir</button></a>';
        $html .= '<a href="task/deletar?id=' . $task->id . '"><button>Deletar</button></a>';
        return $html;
    }

    #[Request('/view/task/editar', method: 'GET')]
    public function editarTask_form(array $data): string {
        $task = $this->taskModel->get((int)$data['id']);
        return <<<HTML
            <h1>Editar Task</h1>
            <form method="post" action="">
                <input type="text" name="descricao" placeholder="Descrição" value="{$task->description}">
                <input type="hidden" name="id" value="{$task->id}">
                <button type="submit">Editar</button>
            </form>
        HTML;
    }

    #[Request('/view/task/editar', method: 'POST')]
    public function editarTask_form_post(array $data): string {
        $this->taskModel->update((int)$data['id'], $data['descricao']);
        return <<<HTML
            <h1>Task Editada</h1>
            <p>A task foi editada com sucesso.</p>
            <a href="../tasks"><button>Ver tarefas</button></a>
        HTML;
    }

    #[Request('/view/task/concluir', method: 'GET')]
    public function concluirTask_form(array $data): string {
        $task = $this->taskModel->setComplete((int)$data['id']);
        return <<<HTML
            <h1>Task Concluída</h1>
            <p>{$task->description}</p>
            <a href="../tasks"><button>Ver tarefas</button></a>
        HTML;
    }

    #[Request('/view/task/deletar', method: 'GET')]
    public function deletarTask_form(array $data): string {
        $task = $this->taskModel->delete((int)$data['id']);
        return <<<HTML
            <h1>Task Deletada</h1>
            <p>A task foi deletada com sucesso.</p>
            <a href="../tasks"><button>Ver tarefas</button></a>
        HTML;
    }

    #[Request('/view/task/criar', method: 'GET')]
    public function criarTask_form(array $data): string {
        return <<<HTML
            <h1>Criar Task</h1>
            <form method="post" action="">
                <label for="descricao">Descrição:</label>
                <input type="text" id="descricao" name="descricao" placeholder="Descrição">
                <button type="submit">Criar</button>
            </form>
        HTML;
    }

    #[Request('/view/task/criar', method: 'POST')]
    public function criarTask_form_post(array $data): string {
        $this->taskModel->create($data['descricao']);
        return <<<HTML
            <h1>Task Criada</h1>
            <p>A task foi criada com sucesso.</p>
            <a href="../tasks"><button>Ver tarefas</button></a>
        HTML;
    }
    /** FIM DOS MÉTODOS DE TESTE */

}