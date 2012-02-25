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

    ///// check talk api
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
			'slide_link' => 'http://www.google.com',
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

	/////check comments api
    public function testApiReturnAllComments() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/comments', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));
        $response = $client->request('GET');

        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(200, $response->getStatus());

        $models = json_decode($response->getBody());

        $this->assertNotEmpty($models);
    }

    public function testApiReturnSingleComments() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/comments/1', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $response = $client->request('GET');

        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(200, $response->getStatus());

        $models = json_decode($response->getBody());

        $this->assertEquals(1, count($models));
    }

    public function testApiCreateComment() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/comments', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $client->setParameterPost(array(
            'talk_id'=> 1,
			'user_id'=> 1,
			'body'=> 'Excellent session!',
			'rating'=> '',
			'is_private'=> 0,
			'create_date'=> '2012-01-23 20:01:53',
        ));
        $client->setHeaders('X-AUTH', '10380b4c41b6d052ee39cece043e9d9a');
        $response = $client->request('POST');

        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(200, $response->getStatus());

        $model = json_decode($response->getBody());

        $this->assertNotEmpty($model->comment_id);
        $this->assertEquals(1, $model->user_id);
		$this->assertEquals(1, $model->talk_id);
        $this->assertEquals('Excellent session!', $model->body);

        Comments::model()->deleteByPk($model->comment_id);
    }

    public function testPreventCreateCommentWithOutApiKey() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/comments', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

         $client->setParameterPost(array(
            'talk_id'=> 1,
			'user_id'=> 1,
			'body'=> 'Excellent session!',
			'rating'=> '',
			'is_private'=> 0,
			'create_date'=> '2012-01-23 20:01:53',
        ));
        
        $response = $client->request('POST');
        $this->assertEquals(false, $response->isSuccessful());
        $this->assertEquals(401, $response->getStatus());
    }

    public function testPreventCreateCommentForWrongApiKey() {
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient('http://localhost/adroit/api/comments', array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $client->setParameterPost(array(
            'talk_id'=> 1,
			'user_id'=> 1,
			'body'=> 'Excellent session!',
			'rating'=> '',
			'is_private'=> 0,
			'create_date'=> '2012-01-23 20:01:53',
        ));
		
        $client->setHeaders('X-AUTH', '10380XXXXb4c41b6d052ee39cece043e9d9a');
        $response = $client->request('POST');
        $this->assertEquals(false, $response->isSuccessful());
        $this->assertEquals(401, $response->getStatus());
    }
	//check user api
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