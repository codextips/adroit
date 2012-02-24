<?php
class CategoryList extends CWidget
{
	public $list = array();
	
    public function init()
    {
        $contents = Categories::model()->findAll();
		$this->list[] = array('label'=>'Categories', 'itemOptions'=>array('class'=>'nav-header'));
		/* @var $content Categories */
		foreach ($contents as $content)
		{
			$this->list[] = array('label'=>$content->title,
				'url'=>array('events/all/category/'.$content->title));
		}
    }
 
    public function run()
    {
        $this->render('categoryListView',array('list'=>  $this->list));
    }
}