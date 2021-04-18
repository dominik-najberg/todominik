<?php declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Repository\TaskListRepository;
use App\Domain\Task\TaskList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineTaskListRepository extends ServiceEntityRepository implements TaskListRepository
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, TaskList::class);
    }

    public function add(TaskList $taskList): void
    {
        $this->_em->persist($taskList);
    }
}
