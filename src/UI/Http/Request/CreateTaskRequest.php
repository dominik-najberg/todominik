<?php declare(strict_types=1);

namespace App\UI\Http\Request;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Webmozart\Assert\Assert;

class CreateTaskRequest
{
    private const DATA_TYPE = 'tasks';

    private UuidInterface $id;
    private UuidInterface $taskListId;
    private UuidInterface $userId;
    private \DateTimeImmutable $dueDate;
    private string $content;

    private function __construct(
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


    public static function fromRequest(Request $request): self
    {
        try {
            $data = $request->request->get('data', []);
            Assert::eq($data['type'], self::DATA_TYPE);

            return new self(
                Uuid::fromString($data['id']),
                Uuid::fromString($data['attributes']['tasklist_id']),
                Uuid::fromString($data['attributes']['user_id']),
                new \DateTimeImmutable($data['attributes']['due_date']),
                $data['attributes']['content'],
            );
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage());
        }
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
