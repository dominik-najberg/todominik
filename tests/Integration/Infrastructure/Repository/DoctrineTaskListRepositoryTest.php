<?php declare(strict_types=1);

namespace App\Tests\Integration\Infrastructure\Repository;

use App\Domain\Task\TaskList;
use App\Infrastructure\Repository\DoctrineTaskListRepository;
use App\Tests\Integration\Infrastructure\DbTestCase;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DoctrineTaskListRepositoryTest extends DbTestCase
{
    private DoctrineTaskListRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->entityManager->getRepository(TaskList::class);
    }

    /**
     * @test
     */
    public function should_save_to_db(): void
    {
        $expected = TaskList::create(Uuid::uuid4(),Uuid::uuid4(),'This name');
        $this->repository->add($expected);

        $this->entityManager->flush();
        $this->entityManager->clear();

        $actual = $this->entityManager->find(TaskList::class, $expected->id());

        self::assertEquals($expected, $actual);
    }
}
