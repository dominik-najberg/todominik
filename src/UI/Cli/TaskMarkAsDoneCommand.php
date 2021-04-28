<?php

namespace App\UI\Cli;

use App\Application\Command\MarkTaskAsDone;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

class TaskMarkAsDoneCommand extends Command
{
    protected static $defaultName = 'task:mark-as-done';
    protected static $defaultDescription = 'Mark a task as done';

    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus, string $name = null)
    {
        parent::__construct($name);

        $this->commandBus = $commandBus;
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('taskId', InputArgument::REQUIRED, 'Task ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $taskId = $input->getArgument('taskId');

        if ($taskId) {
            $io->note(sprintf('Task %s is being processed', $taskId));
        }

        try {
            $this->commandBus->dispatch(
                new MarkTaskAsDone(Uuid::fromString($taskId), Uuid::uuid4())
            );
        } catch (Exception $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }

        $io->success('Task marked as done.');

        return Command::SUCCESS;
    }
}
