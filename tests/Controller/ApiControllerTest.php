<?php
namespace App\Tests;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class ApiControllerTest extends TestCase
{
    public function testGetRecipes()
    {
        $client = new Client();
        $uri = 'http://localhost/coding-exercise-backend/public/index.php/api/v1/recipe/garlic' ;
        $response = $client->request('GET', $uri);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetScreenData()
    {
        $client = new Client();
        $uri = 'http://localhost/coding-exercise-backend/public/index.php/api/v1/screendata' ;
        $response = $client->request('GET', $uri);
        $this->assertEquals(200, $response->getStatusCode());
    }
}