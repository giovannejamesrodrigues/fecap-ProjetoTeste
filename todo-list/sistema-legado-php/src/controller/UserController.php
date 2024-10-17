<?php declare(strict_types=1);
namespace Controller;

use Attributes\Request;
use \Exceptions\JsonException;
use Model\User;

class UserController extends Controller {

    private User $userModel;

    #[Request('/login', 'POST')]
    public function login(array $data): array {
        if(!isset($data['login']) || !isset($data['senha'])) {
            throw new JsonException('Login e senha são obrigatórios', 400);
        }

        $token = $this->userModel->login(
            login: $data['login'],
            senha: $data['senha']
        );

        return [
            'token' => $token
        ];
    }

    #[Request('/register', 'POST')]
    public function register(array $data): array {
        if(!isset($data['login']) || !isset($data['senha'])) {
            throw new JsonException('Login e senha são obrigatórios', 400);
        }

        $this->userModel->register(
            login: $data['login'],
            senha: $data['senha']
        );
        $token = $this->userModel->login(
            login: $data['login'],
            senha: $data['senha']
        );

        return [
            'token' => $token
        ];
    }


    /** INÍCIO DOS MÉTODOS DE TESTE */
    #[Request('/view/login', 'GET')]
    public function login_form(array $data): string {
        return <<<HTML
            <h1>Login</h1>
            <form method="post" action="">
                <input type="text" name="login" placeholder="Login">
                <input type="password" name="senha" placeholder="Senha">
                <button type="submit">Login</button>
            </form>
        HTML;
    }

    #[Request('/view/login', 'POST')]
    public function login_form_act(array $data): string {
        return "<pre>{$this->userModel->login($data['login'], $data['senha'])}</pre>";
    }

    #[Request('/view/register', 'GET')]
    public function register_form(array $data): string {
        return <<<HTML
            <h1>Registrar</h1>
            <form method="post" action="">
                <input type="text" name="login" placeholder="Login">
                <input type="password" name="senha" placeholder="Senha">
                <button type="submit">Registrar</button>
            </form>
        HTML;
    }

    #[Request('/view/register', 'POST')]
    public function register_form_act(array $data): string {
        return "<pre>{$this->register($data['login'], $data['senha'])}</pre>";
    }

    #[Request('/view/', 'GET')]
    public function home(array $data): string {
        return <<<HTML
            <h1>Todo</h1>
            <a href="login">Login</a>
            <a href="register">Registrar</a>
            <a href="tasks">Tasks</a>
        HTML;
    }
    /** FIM DOS MÉTODOS DE TESTE */

}