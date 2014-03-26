<?php

class SpravController extends Controller
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
			array('allow',
				'actions'=>array('index','view'),
				'users'=>array('*'),
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
		if(Yii::app()->getLanguage()=="ru"){
			$model=Region::model()->with('auth_ru')->findAll(Array('order'=>'t.id','condition'=>'t.lang="ru" and t.ref_id="1"','together'=>true));
		}else{
			$model=Region::model()->with('auth_ua')->findAll(Array('order'=>'t.id','condition'=>'t.lang="ua" and t.ref_id="1"','together'=>true));
		}

		$this->render('index',array(
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
		if(Yii::app()->getLanguage()=="ru"){$lang="ru";}else{$lang="ua";}
		$model=Region::model()->findByPk(array('id'=>$id,'lang'=>$lang));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
