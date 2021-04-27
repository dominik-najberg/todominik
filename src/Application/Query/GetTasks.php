<?php declare(strict_types=1);

namespace App\Application\Query;

use Ramsey\Uuid\UuidInterface;

class GetTasks
{
    private UuidInterface $listId;

    public function __construct(UuidInterface $listId)
    {
        $this->listId = $listId;
    }

    public function listId(): UuidInterface
    {
        return $this->listId;
    }
}