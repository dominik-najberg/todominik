<?php declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Repository\TaskRepository;
use App\Domain\Task\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
}
