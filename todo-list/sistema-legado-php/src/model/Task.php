<?php declare(strict_types=1);
namespace Model;

class Task extends Model {
    const CREATE = <<<'SQL'
        CREATE TABLE IF NOT EXISTS tasks (id INTEGER PRIMARY KEY, userId INTEGER, createdAt DATETIME, description TEXT, done BOOLEAN);
    SQL;

    public function getTasks(object $user): array {
        $stmt = $this->pdo->prepare('SELECT * FROM tasks WHERE userId = :userId');
        $stmt->execute([':userId' => $user->id]);
        return $stmt->fetchAll();
    }

    public function getTask(object $user, int $taskId): object {
        $stmt = $this->pdo->prepare('SELECT * FROM tasks WHERE id = :id AND userId = :userId');
        $stmt->execute([':id' => $taskId, ':userId' => $user->id]);
        return $stmt->fetchObject();
    }

    public function createTask(object $user, string $description): void {
        $stmt = $this->pdo->prepare('INSERT INTO tasks (userId, createdAt, description, done) VALUES (:userId, :createdAt, :description, :done)');
        $stmt->execute([':userId' => $user->id, ':createdAt' => date('Y-m-d H:i:s'), ':description' => $description, ':done' => false]);
    }

    public function updateTask(object $user, int $taskId, string $description): void {
        $stmt = $this->pdo->prepare('UPDATE tasks SET description = :description WHERE id = :id AND userId = :userId');
        $stmt->execute([':id' => $taskId, ':userId' => $user->id, ':description' => $description]);
    }

    public function deleteTask(object $user, int $taskId): void {
        $stmt = $this->pdo->prepare('DELETE FROM tasks WHERE id = :id AND userId = :userId');
        $stmt->execute([':id' => $taskId, ':userId' => $user->id]);
    }

    public function completeTask(object $user, int $taskId): void {
        $stmt = $this->pdo->prepare('UPDATE tasks SET done = :done WHERE id = :id AND userId = :userId');
        $stmt->execute([':id' => $taskId, ':userId' => $user->id, ':done' => true]);
    }

}