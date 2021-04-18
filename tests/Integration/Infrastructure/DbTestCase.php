<?php declare(strict_types=1);

namespace App\Tests\Integration\Infrastructure\Repository;

use App\Tests\Integration\Util\Seeder\DbTableTruncator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DbTestCase extends KernelTestCase
{
    protected EntityManagerInterface $entityManager;

    protected function truncateTable(string $className): void
    {
        $this->entityManager = self::$container->get('doctrine')->getManager();

        $truncator = new DbTableTruncator($this->entityManager);
        $truncator->truncate($className);
    }
}
