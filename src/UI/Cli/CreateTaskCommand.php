<?php

namespace App\UI\Cli;

use App\Application\Command\CreateTask;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateTaskCommand extends Command
{
    protected static $defaultName = 'task:create';
    protected static $defaultDescription = 'Create a task';

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
            ->addArgument('content', InputArgument::REQUIRED, 'Task Content')
            ->addOption('taskListId', 'list', InputArgument::OPTIONAL, '(optional) Task List ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $content = $input->getArgument('content');
        $taskId = Uuid::uuid4();
        $listId = $input->getOption('taskListId') ? Uuid::fromString($input->getOption('taskListId')): Uuid::uuid4();
        $userId = Uuid::uuid4();

        if ($content) {
            $io->note(sprintf('Task %s is being processed', $content));
        }

        try {
            $this->commandBus->dispatch(
                new CreateTask(
                    $taskId,
                    $listId,
                    $userId,
                    new \DateTimeImmutable('+1 DAY'),
                    $content
                )
            );
        } catch (Exception $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }

        $io->success(sprintf('Task created successfully: %s.', $taskId->toString()));

        return Command::SUCCESS;
    }
}
