<?php

class ApiTest extends CTestCase {

    public function testApiReturnAllEvents() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/events', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));
        $response = $client->request('GET');

        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(200, $response->getStatus());

        $models = json_decode($response->getBody());

        $this->assertNotEmpty($models);
    }

    public function testApiReturnSingleEvent() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/events/1', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $response = $client->request('GET');

        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(200, $response->getStatus());

        $models = json_decode($response->getBody());

        $this->assertEquals(1, count($models));
    }

    public function testApiCreateEvent() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/events', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $client->setParameterPost(array(
            'title' => 'Api Test',
            'summary' => 'Api Test',
            'logo' => 'Api Test',
            'location' => 'Api Test',
            'href' => 'Api Test',
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d'),
            'is_active' => 1,
            'total_attending' => 0,
        ));
        $client->setHeaders('X-AUTH', '10380b4c41b6d052ee39cece043e9d9a');
        $response = $client->request('POST');

        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(200, $response->getStatus());

        $model = json_decode($response->getBody());

        $this->assertNotEmpty($model->event_id);
        $this->assertEquals('Api Test', $model->title);
        $this->assertEquals('Api Test', $model->summary);
        $this->assertEquals('Api Test', $model->location);
        $this->assertEquals(1, $model->is_active);

        Events::model()->deleteByPk($model->event_id);
    }

    public function testPreventCreateEventWithOutApiKey() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/events', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $client->setParameterPost(array(
            'title' => 'Api Test',
            'summary' => 'Api Test',
            'logo' => 'Api Test',
            'location' => 'Api Test',
            'href' => 'Api Test',
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d'),
            'is_active' => 1,
            'total_attending' => 0,
        ));
        $response = $client->request('POST');
        $this->assertEquals(false, $response->isSuccessful());
        $this->assertEquals(401, $response->getStatus());
    }

    public function testPreventCreateEventForWrongApiKey() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/events', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $client->setParameterPost(array(
            'title' => 'Api Test',
            'summary' => 'Api Test',
            'logo' => 'Api Test',
            'location' => 'Api Test',
            'href' => 'Api Test',
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d'),
            'is_active' => 1,
            'total_attending' => 0,
        ));
        $client->setHeaders('X-AUTH', '10380XXXXb4c41b6d052ee39cece043e9d9a');
        $response = $client->request('POST');
        $this->assertEquals(false, $response->isSuccessful());
        $this->assertEquals(401, $response->getStatus());
    }

    /////
    public function testApiReturnAllTalks() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/talks', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));
        $response = $client->request('GET');

        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(200, $response->getStatus());

        $models = json_decode($response->getBody());

        $this->assertNotEmpty($models);
    }

    public function testApiReturnSingleTalk() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/talks/1', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $response = $client->request('GET');

        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(200, $response->getStatus());

        $models = json_decode($response->getBody());

        $this->assertEquals(1, count($models));
    }

    public function testApiCreateTalk() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/talks', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $client->setParameterPost(array(
            'event_id' => 1,
            'title' => 'Api Test',
            'summary' => 'Api Test',
            'speaker' => 'Api Test',
            'total_comments' => 0,
            'rating' => 0,
            'rate_count' => 0,
        ));
        $client->setHeaders('X-AUTH', '10380b4c41b6d052ee39cece043e9d9a');
        $response = $client->request('POST');

        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(200, $response->getStatus());

        $model = json_decode($response->getBody());

        $this->assertNotEmpty($model->talk_id);
        $this->assertEquals(1, $model->event_id);
        $this->assertEquals('Api Test', $model->title);
        $this->assertEquals('Api Test', $model->summary);
        $this->assertEquals('Api Test', $model->speaker);

        Talks::model()->deleteByPk($model->talk_id);
    }

    public function testPreventCreateTalkWithOutApiKey() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/talks', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $client->setParameterPost(array(
            'event_id' => 1,
            'title' => 'Api Test',
            'summary' => 'Api Test',
            'speaker' => 'Api Test',
            'total_comments' => 0,
            'rating' => 0,
            'rate_count' => 0,
        ));
        
        $response = $client->request('POST');
        $this->assertEquals(false, $response->isSuccessful());
        $this->assertEquals(401, $response->getStatus());
    }

    public function testPreventCreateTalkForWrongApiKey() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/talks', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $client->setParameterPost(array(
            'event_id' => 1,
            'title' => 'Api Test',
            'summary' => 'Api Test',
            'speaker' => 'Api Test',
            'total_comments' => 0,
            'rating' => 0,
            'rate_count' => 0,
        ));
        $client->setHeaders('X-AUTH', '10380XXXXb4c41b6d052ee39cece043e9d9a');
        $response = $client->request('POST');
        $this->assertEquals(false, $response->isSuccessful());
        $this->assertEquals(401, $response->getStatus());
    }

}