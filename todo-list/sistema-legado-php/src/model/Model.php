<?php declare(strict_types=1);
namespace Model;

class Model {
    protected \PDO $pdo;

    public function __construct() {
        $this->pdo = new \PDO('sqlite:' . __DIR__ . '/../database.sqlite');
    }

    public static function _setup(): void {
        $db = new Model;

        try {
            $db->pdo->query('SELECT 1 FROM users WHERE login = "admin" LIMIT 1');
            return;
        } catch(\Exception) {
            $db->pdo->exec(Task::CREATE);
            $db->pdo->exec(User::CREATE);
        }
    }
}