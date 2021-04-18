<?php declare(strict_types=1);

namespace App\Tests\Integration\Infrastructure\Repository;

use App\Domain\Task\TaskList;
use App\Infrastructure\Repository\DoctrineTaskListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DoctrineTaskListRepositoryTest extends KernelTestCase
{
    private EntityManagerInterface     $manager;
    private DoctrineTaskListRepository $repository;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->manager    = self::$container->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(TaskList::class);
    }

    /**
     * @test
     */
    public function should_save_to_db(): void
    {
        $expected = TaskList::create(Uuid::uuid4(),Uuid::uuid4(),'This name');
        $this->repository->add($expected);
        $this->manager->flush();
        $this->manager->clear();

        $actual = $this->manager->find(TaskList::class, $expected->id());

        self::assertEquals($expected, $actual);
    }
}
