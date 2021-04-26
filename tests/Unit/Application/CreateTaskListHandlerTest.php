<?php declare(strict_types=1);

namespace App\Tests\Unit\Application;

use App\Application\Command\CreateTaskList;
use App\Application\Command\CreateTaskListHandler;
use App\Application\Repository\TaskListRepository;
use App\Domain\Event\TaskListCreated;
use App\Domain\Task\TaskList;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateTaskListHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function should_handle(): void
    {
        $taskListId = Uuid::fromString('5f2c7b14-58a5-4f4f-912f-0ea7e8fa90e1');
        $userId = Uuid::fromString('4fffb192-3182-4630-9b2b-13278565a42e');
        $name = 'Awesome task list';
        $createdAt = new \DateTimeImmutable();

        $command = new CreateTaskList($taskListId, $userId, $name, $createdAt);
        $event = new TaskListCreated($taskListId->toString(), $userId->toString(), $name, $createdAt);

        $eventBus = $this->createMock(MessageBusInterface::class);
        $eventBus
            ->expects(self::once())
            ->method('dispatch')
            ->with($event)
            ->willReturn(new Envelope($event));

        $taskListRepository = $this->createMock(TaskListRepository::class);
        $taskListRepository
            ->expects(self::once())
            ->method('add')
            ->with(self::isInstanceOf(TaskList::class));

        $handler = new CreateTaskListHandler($eventBus, $taskListRepository);
        $handler($command);
    }

}
