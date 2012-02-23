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
		'brand'=>'Pathshala',
		'brandUrl'=>  Yii::app()->baseUrl,
		'collapse'=>true, // requires bootstrap-responsive.css
		'items'=>array(
			array(
				'class'=>'bootstrap.widgets.BootMenu',
				'items'=>array(
					array('label'=>'Home', 'url'=>'#', 'active'=>true),
					array('label'=>'Link', 'url'=>'#'),
					array('label'=>'Dropdown', 'url'=>'#', 'items'=>array(
						array('label'=>'DROPDOWN HEADER', 'itemOptions'=>array('class'=>'nav-header')),
						array('label'=>'Action', 'url'=>'#'),
						array('label'=>'Another action', 'url'=>'#'),
						array('label'=>'Something else here', 'url'=>'#'),
						'---',
						array('label'=>'Separated link', 'url'=>'#'),
					)),
				),
			),
			'<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
			array(
				'class'=>'bootstrap.widgets.BootMenu',
				'htmlOptions'=>array('class'=>'pull-right'),
				'items'=>array(
					array('label'=>'Link', 'url'=>'#'),
					array('label'=>'Dropdown', 'url'=>'#', 'items'=>array(
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
</body>
</html>
