<?php declare(strict_types=1);

namespace App\Application\Command;

use Ramsey\Uuid\UuidInterface;

class CreateTask
{
    private UuidInterface $id;
    private UuidInterface $taskListId;
    private UuidInterface $userId;
    private \DateTimeImmutable $dueDate;
    private string $content;

    public function __construct(
        UuidInterface $id,
        UuidInterface $taskListId,
        UuidInterface $userId,
        \DateTimeImmutable $dueDate,
        string $content
    ) {
        $this->id = $id;
        $this->taskListId = $taskListId;
        $this->userId = $userId;
        $this->dueDate = $dueDate;
        $this->content = $content;
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function taskListId(): UuidInterface
    {
        return $this->taskListId;
    }

    public function userId(): UuidInterface
    {
        return $this->userId;
    }

    public function dueDate(): \DateTimeImmutable
    {
        return $this->dueDate;
    }

    public function content(): string
    {
        return $this->content;
    }
}