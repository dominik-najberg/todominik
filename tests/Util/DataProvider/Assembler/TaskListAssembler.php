<?php declare(strict_types=1);

namespace App\Tests\Util\DataProvider\Assembler;

use App\Domain\Task\TaskList;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class TaskListAssembler
{
    private UuidInterface $id;
    private UuidInterface $userId;
    private string $name;

    public function __construct()
    {
        $this->id = Uuid::fromString('8b28797e-2210-4a10-b4b5-32cae88b49b5');
        $this->userId = Uuid::fromString('5f4df46d-0812-4f72-bbb3-0c6e35231dd7');
        $this->name = 'Task List Test Name';
    }

    public static function new(): self
    {
        return new self();
    }

    public function assemble(): TaskList
    {
        return TaskList::create(
            $this->id,
            $this->userId,
            $this->name,
        );
    }
}