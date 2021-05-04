<?php declare(strict_types=1);

namespace App\Domain\Event;

class TaskCreated
{
    private const DATETIME_FORMAT = 'Y-m-d H:i:s.u';

    private string $id;
    private string $taskListId;
    private string $userId;
    private string $dueDate;
    private string $content;
    private string $createdAt;

    public function __construct(
        string $id,
        string $taskListId,
        string $userId,
        string $dueDate,
        string $content,
        \DateTimeImmutable $createdAt
    ) {
        $this->id = $id;
        $this->taskListId = $taskListId;
        $this->userId = $userId;
        $this->dueDate = $dueDate;
        $this->content = $content;
        $this->createdAt = $createdAt->format(self::DATETIME_FORMAT);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function taskListId(): string
    {
        return $this->taskListId;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function dueDate(): string
    {
        return $this->dueDate;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat(self::DATETIME_FORMAT, $this->createdAt);
    }
}