<?php declare(strict_types=1);

namespace App\Domain\Event;

use Ramsey\Uuid\UuidInterface;

class TaskListCreated
{
    private string $id;
    private string $userId;
    private string $name;
    private string $createdAt;

    public function __construct(string $id, string $userId, string $name, string $createdAt)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->createdAt = $createdAt;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }
}
