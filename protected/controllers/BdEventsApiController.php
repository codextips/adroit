<?php

class BdEventsApiController extends Controller {

	public function actionConsume() {
		$this->layout = "//layouts/column2";
		try{
			switch ($_GET['model']) {
				case 'events': // {{{
					Yii::import('ext.EHttpClient.*');
					$client = new EHttpClient(Yii::app()->params['bd_events_api'] . 'events', array(
								'maxredirects' => 3,
								'timeout' => 30,
								'adapter' => 'EHttpClientAdapterCurl'));
					$response = $client->request('GET');
					if ($response->isSuccessful()) {
						$events = json_decode($response->getBody());
						if (!empty($events)) {
							$count = 0;
							foreach ($events as $event) {
								$new_event = new Events;
								$new_event->attributes = array(
									'user_id' => 1,
									'title' => $event->name,
									'summary' => $event->description,
									'logo' => null,
									'location' => null,
									'href' => $event->href,
									'start_date' => date('Y-m-d', strtotime($event->start_date)),
									'end_date' => date('Y-m-d', strtotime($event->end_date)),
									'is_active' => 1,
									'total_attending' => 0,
								);
								if ($new_event->duplicateExist()) {
									break;
								} else {
									if ($new_event->save()) {
										++$count;
									}
								}
							}
							Yii::app()->user->setFlash('success', "Total $count events synchronized successfully.");
						}
					} else {
						Yii::app()->user->setFlash('error', "Can not connect with BD EVENTS API.");
					}
					break;
				default:
					exit;
			}
		}catch(EHttpClientException $ex){
			Yii::app()->user->setFlash('error', "Can not connect with BD EVENTS API.");
		}
		$this->render('consume');
	}

}