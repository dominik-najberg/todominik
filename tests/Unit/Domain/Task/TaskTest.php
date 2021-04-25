<?php declare(strict_types=1);

namespace App\Tests\Unit\Domain\Task;

use App\Domain\Task\Task;
use App\Tests\Unit\Domain\Event\TaskMarkedAsDone;
use App\Tests\Util\DataProvider\Assembler\TaskAssembler;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class TaskTest extends TestCase
{
    /**
     * @test
     */
    public function should_create(): void
    {
        $id         = Uuid::fromString('8dd6b115-e3b4-4189-8e23-c5d9081624bb');
        $taskListId = Uuid::fromString('c1630d83-2995-475e-864c-158b3f21542f');
        $userId     = Uuid::fromString('c1630d83-2995-475e-864c-158b3f21542f');
        $content    = 'Very important task';
        $dueDate = new \DateTimeImmutable();

        $actual = Task::create($id, $taskListId, $userId, $dueDate, $content);

        self::assertEquals($id, $actual->id());
        self::assertEquals($taskListId, $actual->taskListId());
        self::assertEquals($userId, $actual->userId());
        self::assertEquals($dueDate, $actual->dueDate());
        self::assertEquals($content, $actual->content());
    }

    /**
     * @test
     */
    public function should_mark_as_done(): void
    {
        $task = TaskAssembler::new()->assemble();
        $expected = new TaskMarkedAsDone($task->id()->toString(), $task->userId()->toString());

        $actual = $task->markAsDone($task->userId());
        self::assertEquals($expected, $actual);
    }
}
