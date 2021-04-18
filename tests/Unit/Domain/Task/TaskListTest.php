<?php declare(strict_types=1);

namespace App\Tests\Unit\Domain\Task;

use App\Domain\Task\TaskList;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class TaskListTest extends TestCase
{
    /**
     * @test
     */
    public function should_create(): void
    {
        $id = Uuid::fromString('428d3479-fe3d-4c66-b9d0-dec160e2eb06');
        $userId = Uuid::fromString('7b3e43cf-4462-4b7b-a423-6e5dd8c454ab');
        $name = 'Fascinating Name';

        $actual = TaskList::create($id, $userId, $name);

        self::assertEquals($id, $actual->id());
        self::assertEquals($userId, $actual->userId());
        self::assertEquals($name, $actual->name());
    }
}
