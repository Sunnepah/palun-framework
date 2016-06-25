<?php

/**
 * Created by PhpStorm.
 * User: sunnepah
 * Date: 6/13/16
 * Time: 10:23 PM
 */
class AddressesControllerTest extends TestCase
{

    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://0.0.0.0:8080'
        ]);
    }

    public function test_get_all_address_list_endpoint_returns_200() {
        $response = $this->client->get('/addresses');

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertNotNull($data);
    }
}
