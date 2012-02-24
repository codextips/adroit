<?php

class SiteController extends Controller {

    public $layout = '//layouts/column2';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $dataProvider = new CActiveDataProvider(
                        Events::model()->upcoming()->active()
        );
        $events = Events::model()->findAll("start_date>= '" . date('Y-m-d') . "' AND is_active=1");
        $this->render('//events/index', array('dataProvider' => $dataProvider));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        if (isset($_GET['type'])) {
            try {
                /*
                 * Do not hard code the host url
                 * load host url from app.ini file
                 */
                $openid = new LightOpenID(Yii::app()->params['host']);

                if (!$openid->mode) {
                    /*
                     * Check Whether OpenID (1.1 and 2.0) authentication is Google or Yahoo!
                     */
                    if ($_GET['type'] == 'google') {
                        $openid->identity = Yii::app()->params['openid.google'];
                    } elseif ($_GET['type'] == 'yahoo') {
                        $openid->identity = Yii::app()->params['openid.yahoo'];
                    }
                    $openid->required = array('namePerson', 'contact/email');
                    $openid->optional = array('namePerson/friendly');
                    header('Location: ' . $openid->authUrl());
                    return;
                } elseif ($openid->mode == 'cancel') {
                    Yii::app()->user->setFlash('info', 'User has cancelled authentication!');
                } else {

                    if ($openid->validate()) {

                        $authData = $openid->getAttributes();

                        $model = new LoginForm(LoginForm::TYPE_OPENID);
                        $model->attributes = array(
                            'username' => $authData['contact/email'],
                            'type' => LoginForm::TYPE_OPENID,
                            'name' => isset($authData['namePerson']) ? @$authData['namePerson'] : @$authData['namePerson/friendly'],
                        );

                        if ($model->validate() && $model->login()) {
                            Yii::app()->user->setFlash('success', '<strong>Successfully authenticated!</strong>. Welcome ' . $authData['contact/email']);
                            $this->redirect(Yii::app()->user->returnUrl);
                            return;
                        } else {
                            Yii::app()->user->setFlash('error', 'Validation error!');
                            $this->redirect(Yii::app()->homeUrl);
                            return;
                        }
                    } else {
                        Yii::app()->user->setFlash('error', 'User was not authenticated!');
                        $this->redirect(Yii::app()->user->returnUrl);
                        return;
                    }
                    $this->redirect(Yii::app()->user->returnUrl);
                    return;
                }
            } catch (ErrorException $e) {
                Yii::app()->user->setFlash('error', 'Exception!');
                $this->redirect(Yii::app()->homeUrl);
                return;
            }
        }

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout(false);
        Yii::app()->user->setFlash('info', 'You are no longer logged in!');
        $this->redirect(Yii::app()->homeUrl);
    }

}