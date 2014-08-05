<?php

class PaymentsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/header_blank';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'userGroupsAccessControl', // perform access control for CRUD operations
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
				'actions'=>array('index','view','add','done','callback'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'groups'=>array('root', 'admin'), 
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($holeid)
	{
		$model=new Payments;
        
        $hole = Holes::model()->findAllByPk($holeid);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Payments']))
		{
			$model->attributes=$_POST['Payments'];
            $model->hole_id = $_POST['Payments']['order_id'];
            $model->user_id = Yii::app()->user->id;
            
			if($model->save())
				$this->redirect(array('done','id'=>$model->id));
		}

		$this->render('add',array(
			'model'=>$model,
            'hole'=>$hole,
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

		if(isset($_POST['Payments']))
		{
			$model->attributes=$_POST['Payments'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Payments');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	   	    $this->pageTitle = Yii::t('titles','NEWS_ADMIN');
		$this->layout='//layouts/header_user';
		$model=new Payments('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Payments']))
			$model->attributes=$_GET['Payments'];
      
      	$this->render('admin',array(
			'model'=>$model,
		));
	}
    
    public function actionAdd($holeid)
    {
		$model=new Payments;
        
        $holes = Holes::model()->findAllByPk($holeid);

		if(isset($_POST['liqpay']))
		{
	    $model->attributes=$_POST['Payments'];
            $model->hole_id = $_POST['Payments']['order_id'];
            $model->user_id = Yii::app()->user->id;
            
			if($model->save())
				$this->redirect(array('done','id'=>$model->id));
		}

		$this->render('add',array(
			'model'=>$model,
                         'holes'=>$holes,
		));
    }
    
        public function actionCallback()
    {
            $model=new Payments;
/*
            $model->hole_id = 6;
            $model->user_id = Yii::app()->user->id;
            $model->transaction_id = 122121;
            $model->status = 21212;
            $model->amount =12323;
            $model->save();
  */          
            
            
              
            if (isset($_POST)) {
                $model->description = $_POST['description'];
            //$model->hole_id = $_POST['order_id'];
            $model->transaction_id = $_POST['transaction_id'];
            $model->status = $_POST['status'];
            $model->amount = $_POST['amount'];
            
            

            $model->save();
        }
/*
        $file = fopen("dump.txt", a);
        $data = $_POST;
        file_put_contents('dump.txt', print_r($data, true), FILE_APPEND);
        fclose($file);
  */
 
    }
    
        public function actionDone()
    {

		$this->render('done');
		
    }


	public function loadModel($id)
	{
		$model=Payments::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Payments $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='payments-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
