<?php declare(strict_types=1);

namespace App\Application\Query\ViewModel;

class TaskDto
{
    private string $content;
    private \DateTimeImmutable $dueDate;

    public function __construct(string $content, \DateTimeImmutable $dueDate)
    {
        $this->content = $content;
        $this->dueDate = $dueDate;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function dueDate(): \DateTimeImmutable
    {
        return $this->dueDate;
    }
}