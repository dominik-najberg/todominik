<?php declare(strict_types=1);

namespace App\Domain\Task;

use App\Domain\Event\TaskMarkedAsDone;
use Ramsey\Uuid\UuidInterface;

class Task
{
    private UuidInterface      $id;
    private UuidInterface      $taskListId;
    private UuidInterface      $userId;
    private \DateTimeImmutable $dueDate;
    private string             $content;
    private bool               $done;

    public function __construct(
        UuidInterface $id,
        UuidInterface $taskListId,
        UuidInterface $userId,
        \DateTimeImmutable $dueDate,
        string $content
    ) {
        $this->id         = $id;
        $this->taskListId = $taskListId;
        $this->userId     = $userId;
        $this->dueDate    = $dueDate;
        $this->content    = $content;
        $this->done       = false;
    }


    public static function create(
        UuidInterface $id,
        UuidInterface $taskListId,
        UuidInterface $userId,
        \DateTimeImmutable $dueDate,
        string $content
    ): self {
        return new self($id, $taskListId, $userId, $dueDate, $content);
    }

    public function markAsDone(UuidInterface $userId): TaskMarkedAsDone
    {
        $this->done = true;

        return new TaskMarkedAsDone($this->id()->toString(), $userId->toString());
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

    public function content(): string
    {
        return $this->content;
    }

    public function dueDate(): \DateTimeImmutable
    {
        return $this->dueDate;
    }

    public function done(): bool
    {
        return $this->done;
    }
}
