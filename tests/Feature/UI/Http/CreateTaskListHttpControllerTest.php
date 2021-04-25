<?php declare(strict_types=1);

namespace App\Tests\Feature\UI\Http;

use App\Domain\Task\TaskList;
use App\Tests\Integration\Util\Seeder\DbTableTruncator;
use App\Tests\Util\DataProvider\Assembler\TaskListAssembler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateTaskListHttpControllerTest extends WebTestCase
{
    private KernelBrowser          $client;
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client  = static::createClient();
        $this->manager = self::$container->get('doctrine')->getManager();

        (new DbTableTruncator($this->manager))->truncate(TaskList::class);
    }


    /**
     * @test
     */
    public function should_get_bad_request_on_missing_post_data(): void
    {
        $this->client->request('POST', '/tasklists');
        $response = $this->client->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function should_create_tasklist_on_valid_request(): void
    {
        $expected = TaskListAssembler::new()->build();

        $this->client->request('POST', '/tasklists', [
            'data' => [
                'type'       => 'tasklists',
                'id'         => $expected->id()->toString(),
                'attributes' => [
                    'name'    => $expected->name(),
                    'user_id' => $expected->userId()->toString(),
                ],
            ],
        ]);

        $response = $this->client->getResponse();
        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());

        self::assertJsonStringEqualsJsonString($response->getContent(), json_encode([
            'data' => [
                'type'       => 'tasklists',
                'id'         => $expected->id()->toString(),
                'attributes' => [
                    'name'   => $expected->name(),
                    'user_id' => $expected->userId()->toString(),
                ],
            ],
        ], JSON_THROW_ON_ERROR));

        $this->manager->clear();
        /** @var TaskList $actual */
        $actual = $this->manager->find(TaskList::class, $expected->id());

        self::assertTrue($expected->id()->equals($actual->id()));
        self::assertTrue($expected->userId()->equals($actual->userId()));
        self::assertEquals($expected->name(), $actual->name());
    }
}
