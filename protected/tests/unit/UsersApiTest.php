<?php

class UsersApiTest extends CTestCase {

    public function testApiReturnAllUsers() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/users', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));
        $response = $client->request('GET');

        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(200, $response->getStatus());

        $models = json_decode($response->getBody());

        $this->assertNotEmpty($models);
    }

    public function testApiReturnSingleUser() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/users/1', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $response = $client->request('GET');

        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(200, $response->getStatus());

        $models = json_decode($response->getBody());

        $this->assertEquals(1, count($models));
    }
}