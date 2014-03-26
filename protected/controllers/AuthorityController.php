<?php

class AuthorityController extends Controller
{
	public $layout='//layouts/header_user';
//	public $layout='//layouts/none';
	private $language="ua";
	private $debug=0;
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
			array('allow',
				'actions'=>array('Index', 'AddAuth','Regions','Holetypes', 'Atypes','Authrel','Typerel'),
				'groups'=>array('root', 'admin'), 
			),
			
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('Hole'),
				'users'=>array('*'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}	

	function init()
	{
		parent::init();
		if(isset(Yii::app()->request->cookies['prefLang']))
			$this->language=Yii::app()->request->cookies['prefLang'];

	}
	public function actionIndex()
	{
		$model = new Authority;
//		$auth = Authority::model()->with("type")->findAll();
		$this->render('index',array("model"=>$model));
	}

	public function actionAddAuth(){
		$lang = $this->language;
		if(isset($_POST['Authority'])){
		$auth = new Authority;
		$auth->attributes=$_POST["Authority"];
		$auth->save();
		}
		$types = AuthorityType::model()->findAll("lang=:lang",array(":lang"=>$lang));
		$region = Region::model()->findByPk(array("id"=>1,"lang"=>$lang));
		$this->render('addAuth',array("types"=>$types,"region"=>$region));
	}
	public function actionRegions()
	{
		$lang = $this->language;
		$region = Region::model()->findByPk(array("id"=>1,"lang"=>$lang));
		$this->render('regions',array("regions"=>$region));
	}

	public function actionHoletypes()
	{
		$model=new HoleTypes;
	
		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='hole-types-holetypes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/
		$err="";
		if(isset($_POST['HoleTypes']))
		{
			$model->attributes=$_POST['HoleTypes'];
			switch($_POST['subBtn']){
				case "Add":
					if($model->validate())
					{
						try{
							$model->save();
							$err="Created";
						}
						catch (Exception $e)
						{
							$err= "some error ".$e->getMessage();
						}
					}
					break;
				case "Edit":
					if($model->validate())
					{
						try{
						$rec=$model->find('id=:id and lang=:lang',array(':id'=>$model->id,':lang'=>$model->lang));
						$rec->attributes=$model->attributes;
						$rec->update();
							$err="Updated";
						}
						catch (Exception $e)
						{
							$err= "some error ".$e->getMessage();
						}
					}
				break;
				case "Delete":
					try{
						$rec=$model->find('id=:id and lang=:lang',array(':id'=>$model->id,':lang'=>$model->lang));
						$rec->delete();
						$err="Deleted";
					}
					catch (Exception $e)
					{
						$err= "some error ".$e->getMessage();
					}
				break;
			}
		}
		$this->render('holetypes',array('model'=>$model,'err'=>$err));
	}
	public function actionAtypes()
	{
		$model=new AuthorityType;

		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='authority-type-atypes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/
		$err="";
		if(isset($_POST['AuthorityType']))
		{
			$model->attributes=$_POST['AuthorityType'];
			if($model->validate())
			{
				// form inputs are valid, do something here
			try{
				$model->save();
			}
			catch (Exception $e)
			{
				$err= "some error ".$e->getMessage();
			}
			}
		}
		$this->render('atypes',array('model'=>$model,'err'=>$err));
	}
	public function actionAuthrel()
	{
		$lang = $this->language;
		$model=new AuthorityRelation;

		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='authority-type-atypes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/
		$err="";
		if(isset($_POST['AuthorityRelation']))
		{
			$model->attributes=$_POST['AuthorityRelation'];
			if($model->validate())
			{
				// form inputs are valid, do something here
			try{
				$model->save();
			}
			catch (Exception $e)
			{
				$err= "some error ".$e->getMessage();
			}
			}
		}
		$auth=Authority::model()->findAll("lang=:lang",array(":lang"=>$lang));
		$this->render('authrel',array('model'=>$model,'auth'=>$auth,'err'=>$err));
	}
	public function actionTyperel()
	{
		$lang = $this->language;
		$model=new AtypeHtypeRel;

		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='authority-type-atypes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/
		$err="";
		if(isset($_POST['AtypeHtypeRel']))
		{
			$model->attributes=$_POST['AtypeHtypeRel'];
			if($model->validate())
			{
				// form inputs are valid, do something here
			try{
				$model->save();
			}
			catch (Exception $e)
			{
				$err= "some error ".$e->getMessage();
			}
			}
		}
		$authtype=AuthorityType::model()->findAll("lang=:lang",array(":lang"=>$lang));
		$holetype=HoleTypes::model()->findAll("lang=:lang",array(":lang"=>$lang));
		$this->render('typerel',array('model'=>$model,'authtype'=>$authtype,'holetype'=>$holetype,'err'=>$err));
	}

	private function getAllAuth($reg, $holetype, $lang){
		if($this->debug)
			echo "Searching for: ".$holetype->name." in ".$reg->name."<br>";
		$result=array();
		foreach($holetype->arel as $trel){
			if($this->debug)
				echo "Responsible for ".$holetype->name." is ".$trel->atype->type."<br>";
			$auth=Authority::model()->findAll("region_id=:region and type=:type and lang=:lang", array(":region"=>$reg->id,":type"=>$trel->at_id,':lang'=>$lang));
			if(count($auth)){
				foreach($auth as $au){
					array_push($result,$au);
					if($this->debug)
						echo "Found: ".$au->name."<br>";
				}
			}else{
				$authtype=$trel->atype;
				if($this->debug)
					echo "Not Found: ".$authtype->type." in ".$reg->name."<br>";
				$regP=$reg->parent;
				if($regP !=null){
					if($regP->id > 0){
						$res=$this->getAuthByType($regP,$authtype,$lang);
						if(strlen($res)){
							array_push($result,$res);
						}
					}
				}
			}
		}
		return $result;
	}
	private function getAuthByType($reg,$authtype,$lang){
		if($this->debug)
			echo "Searching for: ".$authtype->type." in ".$reg->name."<br>";
		$auth=Authority::model()->findAll("region_id=:region and type=:type and lang=:lang", array(":region"=>$reg->id,":type"=>$authtype->id,':lang'=>$lang));
		if(count($auth)){
			foreach($auth as $au){
				$result=$au;
				if($this->debug)
					echo "Found: ".$au->name." in ".$reg->name."<br>";
			}
		}else{
			if($this->debug)
				echo "Not Found: ".$authtype->type." in ".$reg->name."<br>";
			$regP=$reg->parent;
			if($regP !=null){
				if($regP->id > 0){
					$result=$this->getAuthByType($regP,$authtype,$lang);
				}
			}
		}
		return $result;
	}
	public function actionHole()
	{
		$lang = $this->language;
		$msg="";
		$model=new Hole;

		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='hole-hole-form')
		{
				echo CActiveForm::validate($model);
				Yii::app()->end();
		}
		*/

		if(isset($_POST['Hole']))
		{
				$a=$_POST['Hole'];
				$reg=Region::model()->findByPk(array('id'=>$a['region'],'lang'=>$lang));
				$holetype=HoleTypes::model()->findByPk(array('id'=>$a['holetype'],'lang'=>$lang));
				if($this->debug)
					echo $reg->name.":".$holetype->name."<br>";
				$result= $this->getAllAuth($reg,$holetype,$lang);
				$msg=$this->renderPartial('holeform',array('result'=>$result, 'holetype'=>$holetype, 'region'=>$reg, 'lang'=>$lang, 'hole_id'=>1),true);
//				return;
		}
		if(isset($_POST['Print'])){
			$print=$_POST['Print'];
			$auth=AuthorityType::model()->findByPk(array('lang'=>$lang,'id'=>$print['auth']))->alias;
			$htype=HoleTypes::model()->findByPk(array('lang'=>$lang,'id'=>$print['holetype']))->alias;
			$tmpl = $auth."_".$htype.'_'.$print['lang'];
			$printer = Yii::app()->Printer;
			if(file_exists(YiiBase::getPathOfAlias($printer->params['templates'])."/dyplates/$tmpl.php")){
				$css = file_get_contents(YiiBase::getPathOfAlias($printer->params['templates'])."/dyplates/".$auth."_".$htype.'.css'); 
				$html = $this->renderFile(YiiBase::getPathOfAlias($printer->params['templates'])."/dyplates/$tmpl.php",array(),true);
				$outname="ukryama-".date("Y-m-d_G-i-s");
				echo $printer->printH2P($html, $css, $outname);
				return;
			}else{
				$msg="Шаблон не найден";
			}

		}
		$region = Region::model()->findByPk(array("id"=>1,"lang"=>$lang));
		$holetype = HoleTypes::model()->findAll("lang=:lang",array(":lang"=>$lang));
		$this->render('hole',array('model'=>$model,'region'=>$region,'holetype'=>$holetype, 'msg'=>$msg));
	}
}
