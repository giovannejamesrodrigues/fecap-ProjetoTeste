<?php declare(strict_types=1);
namespace Model;

class User extends Model {
    const CREATE = <<<'SQL'
        CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, createdAt DATETIME, login TEXT UNIQUE, senha TEXT);
        INSERT INTO users (createdAt, login, senha) VALUES ('2024-10-15 20:00:00', 'admin', '$2y$10$XbdSlKQl7FpXAqUkZbHsOuGrHTq2ODf8.KhpV1WUdPsnFRhvTNcRi');
    SQL;

    public function login(string $login, string $senha): object {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE login = :login AND senha = :senha');
        $stmt->execute([':login' => $login, ':senha' => $senha]);
        return $stmt->fetchObject();
    }

    public function register(string $login, string $senha): void {
        $stmt = $this->pdo->prepare('INSERT INTO users (createdAt, login, senha) VALUES (:createdAt, :login, :senha)');
        $stmt->execute([':createdAt' => date('Y-m-d H:i:s'), ':login' => $login, ':senha' => \password_hash($senha, PASSWORD_DEFAULT)]);
    }

}
