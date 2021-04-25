<?php declare(strict_types=1);

namespace App\Tests\Feature\UI\Http;

use App\Domain\Task\Task;
use App\Tests\Integration\Util\Seeder\DbTableTruncator;
use App\Tests\Util\DataProvider\Assembler\TaskAssembler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateTaskHttpControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->manager = self::$container->get('doctrine')->getManager();

        (new DbTableTruncator($this->manager))->truncate(Task::class);
    }


    /**
     * @test
     */
    public function should_get_bad_request_on_missing_post_data(): void
    {
        $this->client->request('POST', '/tasks');
        $response = $this->client->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }


    /**
     * @test
     */
    public function should_create_tasklist_on_valid_request(): void
    {
        $expected = TaskAssembler::new()->assemble();

        $this->client->request(
            'POST',
            '/tasks',
            [
                'data' => [
                    'type' => 'tasks',
                    'id' => $expected->id()->toString(),
                    'attributes' => [
                        'content' => $expected->content(),
                        'due_date' => $expected->dueDate()->format('Y-m-d H:i:s.u'),
                        'user_id' => $expected->userId()->toString(),
                        'tasklist_id' => $expected->taskListId()->toString(),
                    ],
                ],
            ]
        );

        $response = $this->client->getResponse();
        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());

        self::assertJsonStringEqualsJsonString(
            $response->getContent(),
            json_encode(
                [
                    'data' => [
                        'type' => 'tasks',
                        'id' => $expected->id()->toString(),
                        'attributes' => [
                            'content' => $expected->content(),
                            'due_date' => $expected->dueDate()->format('Y-m-d H:i:s.u'),
                            'user_id' => $expected->userId()->toString(),
                            'tasklist_id' => $expected->taskListId()->toString(),
                        ],
                    ],
                ],
                JSON_THROW_ON_ERROR
            )
        );

        $this->manager->clear();
        /** @var Task $actual */
        $actual = $this->manager->find(Task::class, $expected->id());

        self::assertNotNull($actual, 'Task missing in the datastore');
        self::assertTrue($expected->id()->equals($actual->id()));
        self::assertTrue($expected->userId()->equals($actual->userId()));
        self::assertEquals($expected->content(), $actual->content());
    }
}