<?php declare(strict_types=1);

namespace App\Infrastructure\AMQP\Message;

class TaskMarkedAsDoneAMQP
{
    private string $taskId;
    private string $userId;
    private \DateTimeImmutable $createdAt;

    public function __construct(string $taskId, string $userId, \DateTimeImmutable $createdAt)
    {
        $this->taskId = $taskId;
        $this->userId = $userId;
        $this->createdAt = $createdAt;
    }

    public function taskId(): string
    {
        return $this->taskId;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}