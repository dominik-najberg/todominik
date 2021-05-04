<?php declare(strict_types=1);

namespace App\Domain\Event;

class TaskListCreated
{
    private const DATETIME_FORMAT = 'Y-m-d H:i:s.u';

    private string $id;
    private string $userId;
    private string $name;
    private string $createdAt;

    public function __construct(string $id, string $userId, string $name, \DateTimeImmutable $createdAt)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->createdAt = $createdAt->format(self::DATETIME_FORMAT);
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

    public function createdAt(): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat(self::DATETIME_FORMAT, $this->createdAt);
    }
}
