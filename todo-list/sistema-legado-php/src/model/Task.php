<?php declare(strict_types=1);
namespace Model;

class Task extends Model {
    const CREATE = <<<'SQL'
        CREATE TABLE IF NOT EXISTS tasks (id INTEGER PRIMARY KEY, userId INTEGER, createdAt DATETIME, description TEXT, done BOOLEAN);
    SQL;

    private object|null $user = null;
    public function setUser(object $user): void {
        $this->user = $user;
    }

    public function list(): array {
        $stmt = $this->pdo->prepare('SELECT * FROM tasks WHERE userId = :userId');
        $stmt->execute([':userId' => $this->user->id]);
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function get(int $taskId): object {
        $stmt = $this->pdo->prepare('SELECT * FROM tasks WHERE id = :id AND userId = :userId');
        $stmt->execute([':id' => $taskId, ':userId' => $this->user->id]);
        return $stmt->fetchObject();
    }

    public function create(string $description): object {
        $stmt = $this->pdo->prepare('INSERT INTO tasks (userId, createdAt, description, done) VALUES (:userId, :createdAt, :description, :done)');
        $stmt->execute([':userId' => $this->user->id, ':createdAt' => date('Y-m-d H:i:s'), ':description' => $description, ':done' => false]);

        $taskId = (int)$this->pdo->lastInsertId();
        return $this->get($taskId);
    }

    public function update(int $taskId, string $description): object {
        $stmt = $this->pdo->prepare('UPDATE tasks SET description = :description WHERE id = :id AND userId = :userId');
        $stmt->execute([':id' => $taskId, ':userId' => $this->user->id, ':description' => $description]);

        return $this->get($taskId);
    }

    public function delete(int $taskId): null {
        $stmt = $this->pdo->prepare('DELETE FROM tasks WHERE id = :id AND userId = :userId');
        $stmt->execute([':id' => $taskId, ':userId' => $this->user->id]);

        return null;
    }

    public function setComplete(int $taskId): object {
        $stmt = $this->pdo->prepare('UPDATE tasks SET done = :done WHERE id = :id AND userId = :userId');
        $stmt->execute([':id' => $taskId, ':userId' => $this->user->id, ':done' => true]);

        return $this->get($taskId);
    }

}