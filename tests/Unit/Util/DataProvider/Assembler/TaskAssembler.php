<?php declare(strict_types=1);

namespace App\Tests\Unit\Util\DataProvider\Assembler;

use App\Domain\Task\Task;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class TaskAssembler
{

    private UuidInterface $id;
    private UuidInterface $taskListId;
    private UuidInterface $userId;
    private \DateTimeImmutable $dateTimeImmutable;
    private string $content;

    private function __construct()
    {
        $this->id         = Uuid::fromString('8dd6b115-e3b4-4189-8e23-c5d9081624bb');
        $this->taskListId = Uuid::fromString('c1630d83-2995-475e-864c-158b3f21542f');
        $this->userId     = Uuid::fromString('c1630d83-2995-475e-864c-158b3f21542f');
        $this->dateTimeImmutable = new \DateTimeImmutable();
        $this->content    = 'Very important task';
    }

    public static function new(): self
    {
        return new self();
    }

    public function assemble(): Task
    {
        return Task::create(
            $this->id,
            $this->userId,
            $this->taskListId,
            $this->dateTimeImmutable,
            $this->content,
        );
    }
}
