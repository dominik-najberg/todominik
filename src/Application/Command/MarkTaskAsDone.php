<?php declare(strict_types=1);

namespace App\Application\Command;

use Ramsey\Uuid\UuidInterface;

class MarkTaskAsDone
{
    private UuidInterface $taskId;
    private UuidInterface $userId;

    public function __construct(UuidInterface $taskId, UuidInterface $userId)
    {
        $this->taskId = $taskId;
        $this->userId = $userId;
    }

    public function taskId(): UuidInterface
    {
        return $this->taskId;
    }

    public function userId(): UuidInterface
    {
        return $this->userId;
    }
}