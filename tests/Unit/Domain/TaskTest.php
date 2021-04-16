<?php declare(strict_types=1);

namespace App\Tests\Unit\Domain;

use App\Domain\Task;
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

        $actual = Task::create($id, $taskListId, $userId, $content);

        self::assertEquals($id, $actual->id());
        self::assertEquals($taskListId, $actual->taskListId());
        self::assertEquals($userId, $actual->userId());
        self::assertEquals($content, $actual->content());
    }
}
