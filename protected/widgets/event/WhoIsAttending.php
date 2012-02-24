<?php
class WhoIsAttending extends CWidget
{
	public $eventID;
	public $attendees = array();
	
    public function init()
    {
       $event = Events::model()->with('attendees')->findByPk($this->eventID);
	   $this->attendees = $event->attendees;
    }
 
    public function run()
    {
        $this->render('whoIsAttendingView',array('attendees'=>  $this->attendees));
    }
}