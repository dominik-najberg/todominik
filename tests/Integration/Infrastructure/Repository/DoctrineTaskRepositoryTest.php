<?php declare(strict_types=1);

namespace App\Tests\Integration\Infrastructure\Repository;

use App\Domain\Task\Task;
use App\Infrastructure\Repository\DoctrineTaskRepository;
use App\Tests\Integration\Infrastructure\DbTestCase;
use App\Tests\Integration\Util\Seeder\DbTableTruncator;
use App\Tests\Util\DataProvider\Assembler\TaskAssembler;

class DoctrineTaskRepositoryTest extends DbTestCase
{
    private DoctrineTaskRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->entityManager->getRepository(Task::class);
        (new DbTableTruncator($this->entityManager))->truncate(Task::class);
    }

    /**
     * @test
     */
    public function should_add_to_db(): void
    {
        $expected = TaskAssembler::new()->assemble();
        $this->repository->add($expected);

        $this->entityManager->flush();
        $this->entityManager->clear();

        $actual = $this->entityManager->find(Task::class, $expected->id());
        self::assertEquals($expected, $actual);
    }
}