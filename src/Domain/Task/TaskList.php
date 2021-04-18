<?php declare(strict_types=1);

namespace App\Domain\Task;

use Ramsey\Uuid\UuidInterface;

class TaskList
{
    private UuidInterface $id;
    private UuidInterface $userId;
    private string $name;

    private function __construct(UuidInterface $id, UuidInterface $userId, string $name)
    {
        $this->id     = $id;
        $this->userId = $userId;
        $this->name   = $name;
    }

    public static function create(UuidInterface $id, UuidInterface $userId, string $name): self
    {
        return new self($id, $userId, $name);
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
}
