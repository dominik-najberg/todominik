<?php declare(strict_types=1);

namespace App\Domain\Event;

class TaskMarkedAsDone
{
    private string $taskId;
    private string $userId;

    public function __construct(string $taskId, string $userId)
    {
        $this->taskId = $taskId;
        $this->userId = $userId;
    }

    public function taskId(): string
    {
        return $this->taskId;
    }

    public function userId(): string
    {
        return $this->userId;
    }
}
