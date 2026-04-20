<?php
namespace App\Tests\Functional;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class TaskApiTest extends ApiTestCase
{
    private EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->entityManager = self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testCreateTask(): void
    {
        $response = static::createClient()->request('POST', '/api/tasks', [
            'json' => [
                'title' => 'Nouvelle tâche',
                'dueDate' => '2024-02-15T14:30:00+02:00'
            ],
        ]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains(['title' => 'Nouvelle tâche']);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testGetTasks(): void
    {
        static::createClient()->request('GET', '/api/tasks');
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }
}