<?php

class BdEventsApiController extends Controller {

    protected $end_point = "http://192.168.1.4/api/";

    public function actionConsume() {
        $this->layout = "//layouts/column2";
        switch ($_GET['model']) {
            case 'events': // {{{
                $response = file_get_contents($this->end_point . 'events');
                $events = json_decode($response);
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
                            'start_date' => date('Y-m-d', strtotime( $event->start_date)),
                            'end_date' => date('Y-m-d', strtotime( $event->end_date)),
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
                break;
            default:
                exit;
        }
        $this->render('consume');
    }

}