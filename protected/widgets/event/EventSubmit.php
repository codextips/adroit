<?php
class EventSubmit extends CWidget
{
	public $content = array();
	
    public function init()
    {
       
    }
 
    public function run()
    {
        $this->render('eventSubmitView',array('content'=>  $this->content));
    }
}