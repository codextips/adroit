<?php

class EventsController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
	public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
	public function filters()
	{
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
	public function accessRules()
	{
        return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','search'),
				'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'attending'),
				'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform attending actions
				'actions'=>array('attending'),
				'users'=>array('@'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
        $comment = new Comments;
        $talk = new Talks;
        $talk->attributes = array(
            'event_id' => $model->event_id,
        );
        $comment->attributes = array(
            'event_id' => $model->event_id,
            'user_id' => Yii::app()->user->id,
        );
        $talksDataProvider = new CActiveDataProvider('Talks', array(
                    'criteria' => array(
                        'condition' => "event_id = $model->event_id",
                    ),
                    'pagination' => array(
                        'pageSize' => 5,
                    ),
                ));
        $commentsDataProvider = new CActiveDataProvider('Comments', array(
                    'criteria' => array(
                        'condition' => "event_id = $model->event_id",
                        'with' => array('commentor'),
                        'order' => 't.create_date DESC'
                    ),
                    'pagination' => array(
                        'pageSize' => 5,
                    ),
                ));
		
		$this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'whoIsAttending'));
		$this->widget('application.widgets.event.WhoIsAttending', array(
		'eventID'=> $id,
		));
		$this->endWidget();

        $this->render('view', array(
            'model' => $model,
            'comment' => $comment,
            'talk' => $talk,
            'talksDataProvider' => $talksDataProvider,
            'commentsDataProvider' => $commentsDataProvider
        ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Events;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Events']))
		{
			$model->attributes=$_POST['Events'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->event_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Events']))
		{
			$model->attributes=$_POST['Events'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->event_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($type='all', $category='')
	{
		if($type == 'upcoming') $dataSource = Events::model()->upcoming()->active();
		else if($type == 'ongoing') $dataSource = Events::model()->ongoing()->active();
		else if($type == 'popular') $dataSource = Events::model()->popular()->active();
		else $dataSource = 'Events';
		
		$category = Categories::model()->findByAttributes(array('title'=>$category));
		if(empty ($category))
		{
			$dataProvider=new CActiveDataProvider($dataSource);
		}
		else
		{
			$dataProvider=new CActiveDataProvider($dataSource, array(
				'criteria'=>array(
					'with'=>array(
						'categories'=>array(
							'condition'=>"events_categories.category_id = $category->category_id",
							'together'=>true,
							'alias'=>'events_categories',
							'joinType'=>'INNER JOIN',
						),
						'attendees'
					),
				),
			));
		}
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Events('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Events']))
			$model->attributes=$_GET['Events'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionSearch()
	{
		$model=new Events('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_REQUEST['Events']))
			$model->attributes=$_REQUEST['Events'];
		$this->render('search',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Events::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='events-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionAttending() {
        $this->layout = null;
        if (isset($_POST['event_id'])) {
            $model = Events::model()->findByPk($_POST['event_id']);
            if ($model) {
                $attendees = $model->attendees(array('condition' => 'attendees.user_id = ' . Yii::app()->user->id));
                if (empty($attendees)) {
                    $attendee = new Attendees;
                    $attendee->attributes = array(
                        'event_id' => $model->event_id,
                        'user_id' => Yii::app()->user->id,
                    );
                    if ($attendee->save()) {
                        $model->total_attending = (int) $model->total_attending + 1;
                        $model->save(false);
                        echo "<i class='icon-user'></i>&nbsp;<strong>You</strong> and <strong>" . ($model->total_attending - 1) . " other people</strong> attending so far!";
                    }
                }
            }
        }
    }
}
