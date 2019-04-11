<?php

namespace App\Tests;

use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Panther\Client;

/**
 * Class AbstractWebTestCase
 * @package App\Tests
 */
abstract class AbstractWebTestCase extends WebTestCase
{
    use RefreshDatabaseTrait,
        TestCaseTrait;

    /**
     * @var Client
     */
    protected $client;

    protected function setUp()
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $parameters
     * @param array $files
     * @param array $server
     * @param null $content
     * @return Response
     */
    protected function request(string $method, string $uri, array $parameters = [], array $files = [], array $server = [], $content = null): Response
    {
        $this->client->request($method, $uri, $parameters, $files, $server, $content);
        return $this->client->getResponse();
    }
}