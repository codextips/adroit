<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- Register Bootstrap CSS framework -->
	<?php echo Yii::app()->bootstrap->registerCss(); ?>

	<!-- Override with custom css -->
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/override.css'); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<?php $this->widget('bootstrap.widgets.BootNavbar', array(
		'fixed'=>true,
		'brand'=>  Yii::app()->name,
		'brandUrl'=>  Yii::app()->baseUrl,
		'collapse'=>true, // requires bootstrap-responsive.css
		'items'=>array(
			array(
				'class'=>'bootstrap.widgets.BootMenu',
				'items'=>array(
					array('label'=>'Home', 'url'=> Yii::app()->baseUrl, 'active'=> ($this->uniqueid == 'site' && $this->action->Id == 'index')? true : false),
					array('label'=>'Events', 'url'=>'#', 'active'=> ($this->uniqueid == 'event')? true : false, 'items'=>array(
						array('label'=>'Browse Events', 'itemOptions'=>array('class'=>'nav-header')),
						array('label'=>'All Events', 'url'=>  Yii::app()->createUrl('events/all')),
						array('label'=>'Upcoming Events', 'url'=>Yii::app()->createUrl('events/upcoming')),
						array('label'=>'Ongoing Events', 'url'=>Yii::app()->createUrl('events/ongoing')),
						array('label'=>'Popular Events', 'url'=>Yii::app()->createUrl('events/popular')),
					)),
					array('label'=>'Contact', 'url'=>Yii::app()->createUrl('site/contact'), 'active'=> ($this->uniqueid == 'site' && $this->action->Id == 'contact')? true : false),
					array('label'=>'About', 'url'=>Yii::app()->createUrl('site/page',array('view'=>'about')), 'active'=> ($this->uniqueid == 'site' && $this->action->Id == 'page')? true : false),
				),
			),
			'<form method = "post" class="navbar-search pull-left" action="'.Yii::app()->createUrl("events/search").'"><input name="Events[summary]", type="text" class="search-query span3" placeholder="Search"></form>',
//			(!Yii::app()->user->isGuest)? 
//				'<span><a href="user/update">' . ((isset(Yii::app()->user->name)) ? Yii::app()->user->name : Yii::app()->user->email).'</a></span> | <a href="site/logout">Logout</a>' :
//                'not log in',
			array(
				'class'=>'bootstrap.widgets.BootMenu',
				'htmlOptions'=>array('class'=>'pull-right'),
				'items'=>array(
					array('label'=> (!Yii::app()->user->isGuest)? ((isset(Yii::app()->user->name))) ? Yii::app()->user->name : Yii::app()->user->email : '',
						'url'=> Yii::app()->createUrl('users/update'), 'visible' => !Yii::app()->user->isGuest),
					array('label'=> 'Logout',
						'url'=> Yii::app()->createUrl('site/logout'), 'visible' => !Yii::app()->user->isGuest),
					array('label'=> 'Login With:',
						'url'=> Yii::app()->createUrl('site/login'), 'visible' => Yii::app()->user->isGuest),
					array('label'=> CHtml::image(Yii::app()->baseUrl . '/images/google_signin.png'), 'linkOptions' => array('style' => 'padding: 8px 1px 8px;'),
						'url'=> Yii::app()->createUrl('site/login?type=google'), 'visible' => Yii::app()->user->isGuest, 'encodeLabel' => false),
					array('label'=> CHtml::image(Yii::app()->baseUrl . '/images/yahoo_signin.png'), 'linkOptions' => array('style' => 'padding: 8px 2px 8px;'),
						'url'=> Yii::app()->createUrl('site/login?type=yahoo'), 'visible' => Yii::app()->user->isGuest, 'encodeLabel' => false),
					array('label'=>'API', 'url'=>'#', 'items'=>array(
						array('label'=>'Action', 'url'=>'#'),
						array('label'=>'Another action', 'url'=>'#'),
						array('label'=>'Something else here', 'url'=>'#'),
						'---',
						array('label'=>'Separated link', 'url'=>'#'),
					)),
				),
			),
		),
	)); ?>
	<div class="container">
		<div class="content">
			<?php
			if(isset($this->breadcrumbs))
			{
				$this->widget('bootstrap.widgets.BootCrumb', array(
					'links'=>$this->breadcrumbs,
					//'htmlOptions'=>array('class'=>'bredcrumbs'),
				));

			}
			?>
			<div class="row">
				<?php echo $content; ?>
			</div>
		</div>
	</div>
</body>
</html>
