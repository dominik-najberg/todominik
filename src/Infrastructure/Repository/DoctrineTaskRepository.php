<?php declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Exception\TaskNotFoundException;
use App\Application\Repository\TaskRepository;
use App\Domain\Task\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

class DoctrineTaskRepository extends ServiceEntityRepository implements TaskRepository
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, Task::class);
    }

    public function add(Task $taskList): void
    {
        $this->_em->persist($taskList);
    }

    /**
     * @throws TaskNotFoundException
     */
    public function getById(UuidInterface $taskId): Task
    {
        $task = $this->findOneBy(['id' => $taskId]);

        if (null === $task){
            throw TaskNotFoundException::fromId($taskId->toString());
        }

        return $task;
    }
}
