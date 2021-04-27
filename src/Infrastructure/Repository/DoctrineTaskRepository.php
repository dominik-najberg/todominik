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
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function add(Task $task): void
    {
        $this->_em->persist($task);
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
