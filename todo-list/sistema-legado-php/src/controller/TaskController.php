<?php declare(strict_types=1);
namespace Controller;

use Attributes\Request;
use \Exceptions\JsonException;

class TaskController extends Controller {

    #[Request('/task', method: 'POST')]
    public function criarTask(array $data): void {
        echo "CRIAR TASK!";
    }

    #[Request('/tasks', method: 'GET')]
    public function listarTasks(array $data): void {
        echo "LISTAR TASKS!";
    }

    #[Request('/task/get', method: 'GET')]
    public function lerTask(array $data): void {
        echo "LER TASKS!";
    }

    #[Request('/task/editar', method: 'POST')]
    public function editarTask(array $data): void {
        echo "EDITAR TASK!";
    }

    #[Request('/task/concluir', method: 'POST')]
    public function concluirTask(array $data): void {
        echo "CONCLUIR TASK!";
    }

}