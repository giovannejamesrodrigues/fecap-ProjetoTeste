<?php declare(strict_types=1);
namespace Model;

use Exceptions\JsonException;

class User extends Model {

    const JWT_SECRET = 'MinhaSenhaSuperSecreta';
    const JWT_EXPIRATION = 3600;

    const CREATE = <<<'SQL'
        CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, createdAt DATETIME, login TEXT UNIQUE, senha TEXT);
        INSERT INTO users (createdAt, login, senha) VALUES ('2024-10-15 20:00:00', 'admin', '$2y$10$XbdSlKQl7FpXAqUkZbHsOuGrHTq2ODf8.KhpV1WUdPsnFRhvTNcRi');
    SQL;

    public function login(string $login, string $senha): string {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE login = :login');
        $stmt->execute([':login' => $login]);
        $user = $stmt->fetchObject();
        if(!$user || !\password_verify($senha, $user->senha)) {
            throw new JsonException('Usuário ou senha inválidos', 401);
        }

        return $this->generateJwt($user);
    }

    public function loginJwt(string $jwt): object {
        return $this->getUserByJwt($jwt);
    }

    public function register(string $login, string $senha): void {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE login = :login');
        $stmt->execute([':login' => $login]);
        if($stmt->fetchObject()) {
            throw new JsonException('Usuário já existe', 400);
        }

        $stmt = $this->pdo->prepare('INSERT INTO users (createdAt, login, senha) VALUES (:createdAt, :login, :senha)');
        $stmt->execute([':createdAt' => date('Y-m-d H:i:s'), ':login' => $login, ':senha' => \password_hash($senha, PASSWORD_DEFAULT)]);
    }

    private function generateJwt(object $user) {
        $header    = \rtrim(\base64_encode(\json_encode(['alg' => 'HS256', 'typ' => 'JWT'])), '=');
        $payload   = \rtrim(\base64_encode(\json_encode(['sub' => $user->id, 'login' => $user->login, 'exp' => \time() + self::JWT_EXPIRATION])), '=');
        $signature = \rtrim(\base64_encode(\hash_hmac('sha256', "{$header}.{$payload}", self::JWT_SECRET, true)), '=');
        return "{$header}.{$payload}.{$signature}";
    }

    private function getUserByJwt(string $jwt): object {
        if(\substr_count($jwt, '.') !== 2) {
            throw new JsonException('Token inválido. Formato inválido.', 401);
        }
        $parts = \explode('.', $jwt);
        $payload = \json_decode(\base64_decode($parts[1]));
        if($payload->exp < \time()) {
            throw new JsonException('Token expirado. Faça login novamente.', 401);
        }
        if(\hash_hmac('sha256', "{$parts[0]}.{$parts[1]}", self::JWT_SECRET, true) !== \base64_decode($parts[2])) {
            throw new JsonException('Token inválido. Assinatura inválida.', 401);
        }

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $payload->sub]);
        return $stmt->fetchObject();
    }

}
