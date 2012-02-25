<?php

class CommentsApiTest extends CTestCase 
{
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
	
	public function testApiUpdateComment() {
		
		$model = new Comments();
		$model->attributes = array(
			'talk_id'=> 1,
			'user_id'=> 1,
			'body'=> 'Excellent session!',
			'rating'=> '',
			'is_private'=> 0,
			'create_date'=> '2012-01-23 20:01:53',
		);
		$model->save();
		
        Yii::import('ext.EHttpClient.*');
        $client = new EHttpClient('http://localhost/adroit/api/comments/'.$model->comment_id, array(
                    'maxredirects' => 3,
                    'timeout' => 30,
                    'adapter' => 'EHttpClientAdapterCurl'));

        $client->setParameterGet(array(
			'body'=> 'Excellent session! updated',
        ));
        $client->setHeaders('X-AUTH', '10380b4c41b6d052ee39cece043e9d9a');
        $response = $client->request('PUT');

        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(200, $response->getStatus());

        $model->delete();
    }
}