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
}
