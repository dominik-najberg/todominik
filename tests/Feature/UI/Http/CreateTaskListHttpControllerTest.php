<?php declare(strict_types=1);

namespace App\Tests\Feature\UI\Http;

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
    public function should_get_http_created_on_valid_request(): void
    {
        $this->client->request('POST', '/tasklists', [
            'data' => [
                'type'       => 'tasklists',
                'id'         => '29ea0ea6-9f89-4019-b187-a90392f0b6ea',
                'attributes' => [
                    'name'    => 'My beautiful task list',
                    'user_id' => '9d6eeaeb-a4a2-4052-ab55-fe9a15582860',
                ],
            ],
        ]);

        $response = $this->client->getResponse();
        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());

        self::assertJsonStringEqualsJsonString($response->getContent(), json_encode([
            'data' => [
                'type'       => 'tasklists',
                'id'         => '29ea0ea6-9f89-4019-b187-a90392f0b6ea',
                'attributes' => [
                    'name'   => 'My beautiful task list',
                    'user_id' => '9d6eeaeb-a4a2-4052-ab55-fe9a15582860',
                ],
            ],
        ], JSON_THROW_ON_ERROR));
    }
}
