<?php declare(strict_types=1);

namespace App\Application\Exception;

class TaskNotFoundException extends \Exception
{
    public static function fromId(string $taskId): self
    {
        return new self(sprintf('Task not found: %s', $taskId));
    }
}