<?php declare(strict_types=1);

namespace App;

use Psr\Log\NullLogger;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TestKernel extends Kernel
{
    /**
     * Solution from https://github.com/symfony/symfony/issues/25676#issuecomment-369619194
     *
     * @param LoaderInterface $loader
     *
     * @throws \Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        parent::registerContainerConfiguration($loader);

        $loader->load(
            static function (ContainerBuilder $container): void {
                // Register a NullLogger to avoid getting the stderr default logger of FrameworkBundle
                $container->register('logger', NullLogger::class);
            }
        );
    }
}