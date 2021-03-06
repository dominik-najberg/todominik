<?php declare(strict_types=1);

namespace App\Tests\Integration\Infrastructure;

use App\Tests\Integration\Util\Seeder\DbTableTruncator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DbTestCase extends KernelTestCase
{
    protected EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        self::bootKernel();
        $this->entityManager = self::$container->get('doctrine')->getManager();
    }

    protected function truncateTable(string $className): void
    {
        (new DbTableTruncator($this->entityManager))->truncate($className);
    }
}
