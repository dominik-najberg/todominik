<?php declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Exception\TaskNotFoundException;
use App\Application\Query\ViewModel\TaskDto;
use App\Application\Repository\GetTasksRepository;
use App\Domain\Task\Task;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class DoctrineGetTasksRepository implements GetTasksRepository
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws TaskNotFoundException
     */
    public function getByListId(UuidInterface $listId): array
    {
        $tasks = $this->entityManager->createQueryBuilder()
            ->from(Task::class, 't')
            ->select(
                sprintf('new %s(t.content, t.dueDate)',TaskDto::class)
            )
            ->where('t.taskListId = :listId')->setParameter('listId', $listId->toString())
            ->getQuery()
            ->getResult();

        if (empty($tasks)) {
            throw TaskNotFoundException::fromListId($listId->toString());
        }

        return $tasks;
    }
}