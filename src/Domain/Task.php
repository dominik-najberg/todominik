<?php declare(strict_types=1);

namespace App\Domain;

use Ramsey\Uuid\UuidInterface;

class Task
{
    private UuidInterface $id;
    private UuidInterface $taskListId;
    private UuidInterface $userId;
    private string        $content;

    private function __construct(UuidInterface $id, UuidInterface $taskListId, UuidInterface $userId, string $content)
    {
        $this->id         = $id;
        $this->taskListId = $taskListId;
        $this->userId     = $userId;
        $this->content = $content;
    }

    public static function create(
        UuidInterface $id,
        UuidInterface $taskListId,
        UuidInterface $userId,
        string $content
    ): self {
        return new self($id, $taskListId, $userId, $content);
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
}
