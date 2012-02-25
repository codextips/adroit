<?php

class EventsApiTest extends CTestCase {

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
	
	public function testApiUpdateEvent() {
		
		$model = new Events();
		$model->attributes = array(
			'title' => 'Api Test',
            'summary' => 'Api Test',
            'logo' => 'Api Test',
            'location' => 'Api Test',
            'href' => 'Api Test',
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d'),
            'is_active' => 1,
            'total_attending' => 0,
		);
		$model->save();
		
        Yii::import('ext.EHttpClient.*');
        $client = new EHttpClient('http://localhost/adroit/api/events/'.$model->event_id, array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $client->setParameterGet(array(
            'title' => 'Api Test Updated',
            'summary' => 'Api Test Updated',
            'logo' => 'Api Test',
            'location' => 'Api Test',
            'href' => 'Api Test',
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d'),
            'is_active' => 0,
            'total_attending' => 1,
        ));
        $client->setHeaders('X-AUTH', '10380b4c41b6d052ee39cece043e9d9a');
        $response = $client->request('PUT');

        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(200, $response->getStatus());

        $model->delete();
    }
	
	public function testApiDeleteEvent() {
		
		$model = new Events();
		$model->attributes = array(
			'title' => 'Api Test',
            'summary' => 'Api Test',
            'logo' => 'Api Test',
            'location' => 'Api Test',
            'href' => 'Api Test',
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d'),
            'is_active' => 1,
            'total_attending' => 0,
		);
		$model->save();
		
        Yii::import('ext.EHttpClient.*');
        $client = new EHttpClient('http://localhost/adroit/api/events/'.$model->event_id, array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $client->setHeaders('X-AUTH', '10380b4c41b6d052ee39cece043e9d9a');
        $response = $client->request('DELETE');
		
		$model = Events::model()->findByPk($model->event_id);

        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(200, $response->getStatus());
		
		$this->assertEmpty($model);
    }
}