<?php declare(strict_types=1);

namespace App\Tests\Integration\Infrastructure\Repository;

use App\Application\Exception\TaskNotFoundException;
use App\Application\Query\ViewModel\TaskDto;
use App\Domain\Task\Task;
use App\Infrastructure\Repository\DoctrineGetTasksRepository;
use App\Tests\Integration\Infrastructure\DbTestCase;
use App\Tests\Integration\Util\Seeder\DbTableTruncator;
use App\Tests\Util\DataProvider\Assembler\TaskAssembler;
use Ramsey\Uuid\Uuid;

class GetTasksRepositoryTest extends DbTestCase
{
    private const TASKLIST_ID = '6d2ccafb-b02f-4ceb-ad3f-506a7f17a217';
    private DoctrineGetTasksRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new DoctrineGetTasksRepository($this->entityManager);
        (new DbTableTruncator($this->entityManager))->truncate(Task::class);

        $taskRepository = $this->entityManager->getRepository(Task::class);

        for ($i = 0; $i < 3; $i++) {
            $taskRepository->add(
                TaskAssembler::new()
                    ->withTaskId(Uuid::uuid4())
                    ->withContent('Task content here')
                    ->withTaskListId(Uuid::fromString(self::TASKLIST_ID))
                    ->assemble()
            );
        }

        $this->entityManager->flush();
    }

    /**
     * @test
     */
    public function should_get_tasks(): void
    {
        $tasks = $this->repository->getByListId(Uuid::fromString(self::TASKLIST_ID));

        self::assertCount(3, $tasks);
        self::assertInstanceOf(TaskDto::class, $tasks[0]);

        /** @var TaskDto $task */
        foreach ($tasks as $task) {
            self::assertEquals('Task content here', $task->content());
        }
    }

    /**
     * @test
     */
    public function should_throw_on_results_not_found(): void
    {
        $this->expectException(TaskNotFoundException::class);
        $this->repository->getByListId(Uuid::uuid4());
    }


}