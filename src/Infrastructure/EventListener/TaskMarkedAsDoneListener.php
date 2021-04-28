<?php declare(strict_types=1);

namespace App\Infrastructure\EventListener;

use App\Domain\Event\TaskMarkedAsDone;
use App\Infrastructure\AMQP\Message\TaskMarkedAsDoneAMQP;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class TaskMarkedAsDoneListener implements MessageHandlerInterface
{
    private MessageBusInterface $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function __invoke(TaskMarkedAsDone $event)
    {
        $this->eventBus->dispatch(
            new TaskMarkedAsDoneAMQP(
                $event->userId(),
                $event->userId(),
                new \DateTimeImmutable(),
            )
        );
    }
}