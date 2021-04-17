<?php declare(strict_types=1);

namespace App\UI\Http\Request;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Webmozart\Assert\Assert;

class CreateTaskListRequest
{
    private const DATA_TYPE = 'tasklists';

    private UuidInterface $id;
    private UuidInterface $userId;
    private string        $name;

    private function __construct(UuidInterface $id, UuidInterface $userId, string $name)
    {
        $this->id     = $id;
        $this->userId = $userId;
        $this->name   = $name;
    }

    public static function fromRequest(Request $request): self
    {
        try {
            $data = $request->request->get('data', []);
            Assert::eq($data['type'], self::DATA_TYPE);

            return new self(
                Uuid::fromString($data['id']),
                Uuid::fromString($data['attributes']['user_id']),
                $data['attributes']['name'],
            );
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage());
        }
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function userId(): UuidInterface
    {
        return $this->userId;
    }

    public function name(): string
    {
        return $this->name;
    }
}

/**
 *             'data' => [
 * 'type'       => 'tasklists',
 * 'id'         => '29ea0ea6-9f89-4019-b187-a90392f0b6ea',
 * 'attributes' => [
 * 'name'    => 'My beautiful task list',
 * 'user_id' => '9d6eeaeb-a4a2-4052-ab55-fe9a15582860',
 * ],
 * ],
 */
