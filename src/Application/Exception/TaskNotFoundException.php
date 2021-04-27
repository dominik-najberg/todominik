<?php declare(strict_types=1);

namespace App\Application\Exception;

class TaskNotFoundException extends \Exception
{
    public static function fromId(string $taskId): self
    {
        return new self(sprintf('Task not found: %s', $taskId));
    }

    public static function fromListId(string $listId): self
    {
        return new self(sprintf('No tasks found for the list id: %s', $listId));
    }
}