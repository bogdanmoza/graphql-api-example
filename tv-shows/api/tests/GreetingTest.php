<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Greeting;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class GreetingTest extends ApiTestCase
{
    // This trait provided by HautelookAliceBundle will take care of refreshing the database content to a known state before each test
    use RefreshDatabaseTrait;

    public function testGetCollection(): void
    {
        // The client implements Symfony HttpClient's `HttpClientInterface`, and the response `ResponseInterface`
        $response = static::createClient()->request('GET', '/tv-shows-service/api/greetings');

        $this->assertResponseIsSuccessful();
        // Asserts that the returned content type is JSON-LD (the default)
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        // Asserts that the returned JSON is a superset of this one
        $this->assertJsonContains([
            '@context' => '/tv-shows-service/api/contexts/Greeting',
            '@id' => '/tv-shows-service/api/greetings',
            '@type' => 'hydra:Collection',
            "hydra:member"=> [
                [
                  "@id" => "/tv-shows-service/api/greetings/1",
                  "@type" => "Greeting",
                  "name" => "codo",
                  "id" => 1
                ]
              ],
        ]);

        // Asserts that the returned JSON is validated by the JSON Schema generated for this resource by API Platform
        // This generated JSON Schema is also used in the OpenAPI spec!
        $this->assertMatchesResourceCollectionJsonSchema(Greeting::class);
    }
}