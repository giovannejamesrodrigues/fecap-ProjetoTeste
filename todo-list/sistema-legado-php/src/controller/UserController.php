<?php declare(strict_types=1);
namespace Controller;

use Attributes\Request;
use \Exceptions\JsonException;

class UserController extends Controller {

    #[Request('/login', 'POST')]
    public function login(array $data): void {
        if(!isset($data['login']) || !isset($data['senha'])) {
            throw new JsonException('Login e senha são obrigatórios', 400);
        }
        echo "LOGIN com login e senha";
    }

    #[Request('/register', 'POST')]
    public function register(array $data): void {
        if(!isset($data['login']) || !isset($data['senha'])) {
            throw new JsonException('Login e senha são obrigatórios', 400);
        }
        echo "REGISTRO com login e senha";
    }

}