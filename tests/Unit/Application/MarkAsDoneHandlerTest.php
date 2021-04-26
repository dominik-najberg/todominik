<?php declare(strict_types=1);

namespace App\Tests\Unit\Application;

use App\Application\Command\MarkTaskAsDone;
use App\Application\Command\MarkTaskAsDoneHandler;
use App\Application\Repository\TaskRepository;
use App\Tests\Util\DataProvider\Assembler\TaskAssembler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class MarkAsDoneHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function should_handle(): void
    {
        $task = TaskAssembler::new()->assemble();

        $taskRepository = $this->createMock(TaskRepository::class);
        $taskRepository
            ->expects(self::once())
            ->method('getById')
            ->with($task->id())
            ->willReturn($task);

        $eventBus = $this->createMock(MessageBusInterface::class);
        $eventBus
            ->expects(self::once())
            ->method('dispatch')
            ->willReturn(new Envelope($task));

        $command = new MarkTaskAsDone($task->id(), $task->userId());
        $handler = new MarkTaskAsDoneHandler($taskRepository, $eventBus);
        $handler($command);
    }
}