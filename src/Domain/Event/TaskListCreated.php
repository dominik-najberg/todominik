<?php declare(strict_types=1);

namespace App\Domain\Event;

use Ramsey\Uuid\UuidInterface;

class TaskListCreated
{
    private UuidInterface $id;
    private UuidInterface $userId;
    private string $name;
    private \DateTimeImmutable $createdAt;

    public function __construct(UuidInterface $id, UuidInterface $userId, string $name, \DateTimeImmutable $createdAt)
    {
        $this->id        = $id;
        $this->userId    = $userId;
        $this->name      = $name;
        $this->createdAt = $createdAt;
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function userId(): UuidInterface
    {
        return $this->userId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
