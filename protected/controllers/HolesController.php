<?php

class HolesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

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
				'actions'=>array('add','smallhole','index','view', 'findRegion', 'findCity', 'map','map2', 'ajaxMap','sai','test2'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('getauth','TrackMail','update', 'personal','personalDelete','requestForm','sent','notsent','reply','fix', 'defix', 'delanswerfile','myarea', 'delpicture','selectHoles','review'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete', 'moderate', 'test','test2','rotate'),
				'groups'=>array('root', 'admin', 'moder'), 
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'itemsSelected'),
				'groups'=>array('root',), 
			),
			array('deny',  // deny all users
				'users'=>array('*'),  
			),
		);
	}
	public function actionGetauth(){
		$auth=$_POST['auth'];
		$lang=$_POST['lang'];
		$data=Authority::model()->findByPk(array("id"=>$auth,"lang"=>$lang));
//		if($data->o_name===""){
			$data->o_name=$data->name;
//		}
		echo "{'address' : '".$data->address.(strlen($data->index)>0?", ".$data->index:"")."', 'name' : '".$data->o_name."'}";
	}
	public function actionFindRegion()
	{
		$q = $_GET['term'];
		if (isset($q)) {
			$lang=Yii::app()->getLanguage();
			if($lang=="uk_ua") $lang="ua";
			$criteria = new CDbCriteria;
			$criteria->params = array(':q' => '%'.trim($q).'%');
			$criteria->condition = 'name LIKE (:q) and lang="'.$lang.'"';
			$regions=Region::model()->findAll($criteria);
			if (!empty($regions)) {
				$out = array();
				foreach ($regions as $p) {
				$out[] = array(
					// expression to give the string for the autoComplete drop-down
					//'label' => preg_replace('/('.$q.')/i', "<strong>$1</strong>", $p->name_full),  
					'label' =>  $p->name,
					'value' => $p->name,
					'id' => $p->id, // return value from autocomplete
				);
				}
			echo CJSON::encode($out);
			Yii::app()->end();
			}
		}
	}
	public function actionTest(){
	if(isset($_POST['hole'])){
		$HoleCheck=new HoleCheck;
		$HoleCheck->hole_id=$_POST['hole'];
		$HoleCheck->type=$_POST['type'];
		$HoleCheck->region_id=$_POST['region_id'];
		if($HoleCheck->save()) echo 1;
		exit;
	}
	echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script><style>span{cursor:pointer;}</style>";
	$holes = Holes::model()->findAll(array('order'=>'ADDRESS'));
	foreach($holes as $hole){
		$region=$hole->region();
		if(count($region)&&!count(HoleCheck::model()->find("hole_id=:hole_id",array(":hole_id"=>$hole->ID)))){
			$holetype=$hole->type->findByPk(array("id"=>$hole->TYPE_ID,"lang"=>"ru"));
			$auth=$hole->getAuthByType($region,2,"ru");
			$regP=$region->parent;
			$top="";
			if($regP->ref_id>0){$top=" - ".$regP->name;}
			echo "<div id='hid_".$hole->ID."'><hr>Hole ID:".$hole->ID."<br>\nAddress: ".$hole->ADDRESS."<br>\nType: ".$holetype->alias."<br>\n Best guess for Region is: ".$region->name.$top."<br>\nAuthority suggested: ".$auth[0]->name."<br>\n";
			echo CHtml::link(Yii::t('holes_view', 'EDIT'), array('update', 'id'=>$hole->ID), array('target'=>'_blank'));
			echo "<div><span onClick='$.post(\"/holes/test\",{hole:".$hole->ID.",type:1,region_id:".$region->id."});$(\"#hid_".$hole->ID."\").remove();' style='background-color:green'>GOOD</span> | <span onClick='$.post(\"/holes/test\",{hole:".$hole->ID.",type:2,region_id:".$region->id."});$(\"#hid_".$hole->ID."\").remove();' style='background-color:red'>BAD</span></div>";
			echo "</div>";
/*
			$reqs=$hole->requests;
			if(count($reqs)){					
				echo "<hr>".$hole->ID." Address: ".$hole->ADDRESS." - Type: ".$holetype->alias." - Region is: ".$region->name."<br>\n";
				foreach($reqs as $req){
					echo "Present: Auth ID: ".$req->gibdd_id.": ".$req->auth_ru->name."<br>\n";
					$auth=$hole->getAllAuth($region,$holetype,"ru");
					foreach($auth as $au){
						if($au->type==2){
							echo "Could be replaced with: ".$au->name."<br>\n";
						}
					}
				}
			}
*/
		}
	}
		return;
	}
	public function actionTest2(){
        /*
	echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script><style>span{cursor:pointer;}</style>";
	$holes = Holes::model()->findAll(array('order'=>'ADDRESS'));
	foreach($holes as $hole){
		$region=$hole->region();
		if(!count($region)){
			$holetype=$hole->type->findByPk(array("id"=>$hole->TYPE_ID,"lang"=>"ru"));
			echo "<div id='hid_".$hole->ID."'><hr>Hole ID:".$hole->ID."<br>\nAddress: ".$hole->ADDRESS."<br>\nType: ".$holetype->alias."<br>\n Best guess for Region is: ".$region->name.$top."<br>\nAuthority suggested: ".$auth[0]->name."<br>\n";
			echo CHtml::link(Yii::t('holes_view', 'EDIT'), array('update', 'id'=>$hole->ID), array('target'=>'_blank'));
			echo "<div><span onClick='$(\"#hid_".$hole->ID."\").remove();' style='background-color:green'>FIXED</span></div>";
			echo "</div>";
		}
	}
		return;
        */
	}

	public function actionFindCity()
		{
		
			$q = $_GET['Holes']['ADR_CITY'];
		   if (isset($q)) {
			   $criteria = new CDbCriteria;	  
			   $criteria->params = array(':q' => trim($q).'%');
			   if (isset($_GET['Holes']['region_id']) && $_GET['Holes']['region_id']) $criteria->condition = 'ADR_CITY LIKE (:q) AND region_id='.$_GET['Holes']['region_id']; 
			   else $criteria->condition = 'ADR_CITY LIKE (:q)'; 
			   $criteria->group='ADR_CITY';
			   $Holes = Holes::model()->findAll($criteria); 
	 
			   if (!empty($Holes)) {
				   $out = array();
				   foreach ($Holes as $p) {
					   $out[] = array(
						   // expression to give the string for the autoComplete drop-down
						   //'label' => preg_replace('/('.$q.')/i', "<strong>$1</strong>", $p->name_full),  
						   'label' =>  $p->ADR_CITY,    
						   'value' => $p->ADR_CITY,
					   );
				   }
				   echo CJSON::encode($out);
				   Yii::app()->end();
			   }
		   }
		}	

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
      
      $this->pageTitle = Yii::t('titles', 'HOLES_VIEW');
      $cs=Yii::app()->getClientScript();
      $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/hole_view.css'); 
      $jsFile = CHtml::asset($this->viewPath.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'view_script.js');
      $cs->registerScriptFile($jsFile);
      $pays = Payments::model()->find('hole_id=:hole_id', array(':hole_id'=>$id));
        
		$this->render('view',array(
			'hole'=>$this->loadModel($id),
                        'pays'=>$pays,
		));
	}
	
	public function actionReview($id)
	{
		$this->redirect(Array('view','id'=>(int)$id));
	}	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionSmallhole(){
		header('Access-Control-Allow-Origin: *');
		$model = new Holes;
		if(isset($_POST['umail'])){
			$users = UserGroupsUser::model()->findAllByAttributes(array(),"email=:email",array(":email"=>$_POST['umail']));
			if(count($users)==0){
				$umodel=new UserGroupsUser('autoregistration');
				$umodel->username=$_POST['umail'];
				$umodel->name=$_POST['uname'];
				$umodel->email=$_POST['umail'];
				$umodel->password=$this->randomPassword();
				if($umodel->save()){$model->USER_ID=$umodel->primaryKey;}
			}else{
				$model->USER_ID=$users[0]->id;
			}


			$model->LATITUDE = $_POST['poslat'];
			$model->LONGITUDE = $_POST['poslon'];
			$model->ADDRESS = $_POST['haddress'];
			$model->TYPE_ID = $_POST['deftype'];
			$model->DATE_CREATED = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
			$model->PREMODERATED = (Yii::app()->user->level > 50) ? 1 : 0; 	
//			$tran = $model->dbConnection->beginTransaction();
//			if ($model->validate()) {
				if($model->save()){
//					$tran->commit();
//					echo $model->primaryKey;
					if($model->savePictures()){
					echo "<script>window.parent.postMessage('Дефект завантажено на сайт УкрЯма. Вам відправлено електронного листа з посиланням для підтвердження адреси електронної пошти. Будь ласка, підтвердіть її для продовження роботи з дефектом. Дякуемо!','http://".parse_url($_SERVER['HTTP_REFERER'],PHP_URL_HOST)."');</script>";
					}else{echo "Couldn't save pictures";}
				}
//			}else{echo "Couldn't validate!";}

		}else{

			//выставляем центр на карте по координатам IP юзера
			$request = new CHttpRequest;
			$geoIp = new EGeoIP();
			$geoIp->locate($request->userHostAddress); 	
			//echo ($request->userHostAddress);
			if ($geoIp->longitude) $model->LATITUDE=$geoIp->longitude;
			if ($geoIp->latitude) $model->LONGITUDE=$geoIp->latitude;
			$page=$this->renderPartial("smallhole", array('model'=>$model),true);
			echo $page;
		}
	}
	public function actionAdd(){
	    $this->pageTitle = Yii::t('titles', 'HOLES_ADD');
		$this->layout = '//layouts/header_blank';
		$model = new Holes;
		$model->USER_ID = Yii::app()->user->id;
		if(isset($_POST['Holes'])){
			$model->attributes = $_POST['Holes'];

        
			if($model->USER_ID===0 || $model->USER_ID === null){
				$users = UserGroupsUser::model()->findAllByAttributes(array(),"email=:email",array(":email"=>$_POST['Holes']['EMAIL']));
				if(count($users)==0){
					$umodel=new UserGroupsUser('autoregistration');
					$umodel->username=$_POST['Holes']['EMAIL'];
					$umodel->name=$_POST['Holes']['FIRST_NAME'];
					$umodel->last_name=$_POST['Holes']['LAST_NAME'];
					$umodel->email=$_POST['Holes']['EMAIL'];
					$umodel->password=$this->randomPassword();
					if($umodel->save()){
					   $model->USER_ID=$umodel->primaryKey;
                       }
					}else{
						$model->USER_ID=$users[0]->id;
					}
			}
			$model->DATE_CREATED = strtotime($_POST['Holes']['DATE_CREATED']);
			if (!$model->DATE_CREATED)
				$model->DATE_CREATED = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
			if ($model->DATE_CREATED < time()-(7 * 86400))
				$model->addError("DATE_CREATED",Yii::t('template', 'DATE_CANT_BE_PAST', array('{attribute}'=>$model->getAttributeLabel('DATE_CREATED')))); 
			
			$model->PREMODERATED = (Yii::app()->user->level > 50) ? 1 : 0; 	

			$model->ROAD_TYPE = $_POST['Holes']['ROAD_TYPE'];

			$tran = $model->dbConnection->beginTransaction();
			if ($model->validate(null, false)) {
				if($model->save() && $model->savePictures()){
					$tran->commit();

					if ($model->PREMODERATED && $model->ROAD_TYPE == 'highway') {
						$this->sendMailToUkrautodor($model);
					}
					if ($model->PREMODERATED) {
						$this->sendMailToSai($model);
					}
					$this->redirect(array('view','id'=>$model->ID));
				}
			}
		}
		else {
			//выставляем центр на карте по координатам IP юзера
			$request = new CHttpRequest;
			$geoIp = new EGeoIP();
			$geoIp->locate($request->userHostAddress); 	
			//echo ($request->userHostAddress);
            
			if ($geoIp->latitude){$model->LATITUDE=$geoIp->latitude;}else{$model->LATITUDE=Yii::app()->params['latitude'];}
			if ($geoIp->longitude){$model->LONGITUDE=$geoIp->longitude;}else{$model->LONGITUDE=Yii::app()->params['longitude'];}
			$model->DATE_CREATED=time();
             
		}
		$this->render('holeform', array('model'=>$model));
	}


	private function randomPassword() {
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, count($alphabet)-1);
        	$pass[$i] = $alphabet[$n];
	    }
	    return $pass;
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
	    $this->pageTitle = Yii::t('titles', 'HOLES_UPDATE');
		$this->layout = '//layouts/header_blank';
		$model=$this->loadChangeModel($id);
		if(!Yii::app()->user->isModer){
			if($model->STATE != Holes::STATE_FRESH)
			throw new CHttpException(403,'Редактирование не нового дефекта запрещено');
		}
		if(isset($_POST['Holes']))
		{
			$model->attributes=$_POST['Holes'];
	$model->DATE_CREATED = strtotime($_POST['Holes']['DATE_CREATED']);
			if ($model->validate(null, false)) {
   			if($model->save() && $model->savePictures())
   				$this->redirect(array('view','id'=>$model->ID));
	}
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	public function actionReply($id=null){
	    $this->pageTitle = Yii::t('titles', 'HOLES_COMMENT');
		$this->layout='//layouts/header_user';
		$hole=$this->loadModel($id);
		if(isset($_POST['answerdate'])){
			$answer = new HoleAnswers;
			$answer->date=strtotime($_POST['answerdate']);
			$answer->comment=$_POST['comment'];

			$requests=$hole->requests_user;
//			if(count($requests)>0){
//				$req=$requests[count($requests)-1];
//				$answer->request_id=$req->id;
				$answer->request_id=$_POST['req_id'];
//			}else{return false;}
			if($answer->save()){ // Успішно зберегли відповідь
				// повідомляемо зацікавленним, що завантажена відповідь:
				$admin_id = 228;	
				$owner_id = $hole->user->id; // власник ями. Тут би ще з'ясувати відправника, бо лише відправник може завантажувати, аби йому не відправляти
			       $mesg1 = $this->renderPartial('application.views.ugmail.answer',
   	  		      Array( 'model' => $hole,), true);
                               Messenger::send($admin_id, "УкрЯма: завантажена відповідь", $mesg1);
                               Messenger::send($owner_id, "УкрЯма: завантажена відповідь", $mesg1);
				// переадресовуємо на сторінку
				$this->redirect(array('view','id'=>$hole->ID));
			}
		}
		$this->render('reply',array('hole'=>$hole));
	}

	public function actionFix($id)
	{
		$this->layout='//layouts/header_user';
		
		$model=$this->loadModel($id);
		$fixmodel=new HoleFixeds;
		$fixmodel->user_id = Yii::app()->user->id;
		$fixmodel->hole_id = $model->ID;
		$fixmodel->date_fix = time();
  

		if (!$model->isUserHole && Yii::app()->user->level < 50){
			if ($model->STATE==Holes::STATE_FIXED || !$model->requests || !$model->requests_user[0]->answers || $model->user_fix)
				throw new CHttpException(403,'Доступ запрещен.');
		}		
		elseif ($model->STATE==Holes::STATE_FIXED && $model->user_fix)
				throw new CHttpException(403,'Доступ запрещен.');		
			
		$model->scenario='fix';
		
		$cs=Yii::app()->getClientScript();
      $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/add_form.css');

		if(isset($_POST['Holes']))
		{
			$model->STATE=Holes::STATE_FIXED;
			$model->COMMENT2=$_POST['Holes']['COMMENT2'];
	$fixmodel->comment = $model->COMMENT2; 
			$model->DATE_STATUS=time();
	$fixmodel->date_fix = strtotime($_POST['fixdate']);   
	
	$tran = $model->dbConnection->beginTransaction();
	
	
			if ($model->save() && $model->savePictures() && $fixmodel->save()){		
	   $tran->commit();
				$this->redirect(array('view','id'=>$model->ID));
			}
		}

		$this->render('fix_form',array(
			'model'=>$model,	
	'fixmodel'=>$fixmodel,
			'newimage'=>new PictureFiles
		));
	}	
	
	public function actionDefix($id)
	{
		$model=$this->loadModel($id);
		if (!$model->user_fix && Yii::app()->user->level < 80)
			throw new CHttpException(403,'Доступ запрещен.');
			
		$model->updateSetinprogress();
			if(!isset($_GET['ajax']))
				$this->redirect(array('view','id'=>$model->ID));
	}	

	//удаление ямы админом или модером
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest && (isset($_POST['id']) || (isset($_POST['DELETE_ALL']) && $_POST['DELETE_ALL'])))
		{
			if (!isset($_POST['DELETE_ALL'])){
			$id=$_POST['id'];
			// we only allow deletion via POST request
			$model=$this->loadModel($id);
			if (isset($_POST['banuser']) && $_POST['banuser']){
				$reason="Забанен";
				$period=100000;
					$usermodel = UserGroupsUser::model()->findByPk($model->USER_ID); 
					$usermodel->setScenario('ban');
					// check if you are trying to ban a user with an higher level
					if ($usermodel->relUserGroupsGroup->level >= Yii::app()->user->level)
						Yii::app()->user->setFlash('user', 'Вы не можете банить пользователей с уровнем выше или равным вашему.');
					else {
						$usermodel->ban = date('Y-m-d H:i:s', time() + ($period * 86400));
						$usermodel->ban_reason = $reason;
						$usermodel->status = UserGroupsUser::BANNED;
						if ($usermodel->update())
							Yii::app()->user->setFlash('user', '{$usermodel->username}\ акаунт забанен до {$usermodel->ban}.');
						else
							Yii::app()->user->setFlash('user', 'Произошла ошибка попробуйте немного позднее');
					}
				}
				
				$model->delete();
			}
			else {
				$holes=Holes::model()->findAll('id IN ('.$_POST['DELETE_ALL'].')');
				$ok=0;
				foreach ($holes as $model)
					if ($model->delete()) $ok++;
				if ($ok==count($holes))  echo 'ok';
			}			

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect($_SERVER['HTTP_REFERER']);
		}
		elseif (Yii::app()->user->groupName=='root'){
			$model=Holes::model()->findByPk((int)$_GET['id']);
			if ($model) $model->delete();
			}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	//удаление ямы пользователем
	public function actionPersonalDelete($id)
	{
        $model=$this->loadChangeModel($id);
        $currentUser = UserGroupsUser::model()->findByPk(Yii::app()->user->id);

        if ($currentUser && (($currentUser->id == $model->user->id) || ($currentUser->level > 1))) {
	   $model->delete();
        }
        else {
	   throw new CHttpException(403,'Доступ запрещен.');
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_POST['ajax']))
	   $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('personal'));
	}	
	
	//форма печати заявления
	public function actionRequestForm($id)
	{
		$lang=$_POST['lang'];

		$holetype=$_POST['hole_type'];
		$defect_type=$_POST['defect_type'];
		$auth=$_POST[$lang.'_auth'];
		$first_authid=$_POST['first_authid'];	
		$to_name=$_POST[$lang.'_to_name'];
		$to_address=$_POST[$lang.'_to_address'];
		$to_index=$_POST[$lang.'_to_index'];
		$from=$_POST[$lang.'_from'];
		$postaddress=$_POST[$lang.'_postaddress'];
		$response_from=$_POST[$lang.'_response_from'];
		$response_date=$_POST[$lang.'_response_date'];
		$forward_to=$_POST[$lang.'_forward_to'];
		$signature=$_POST[$lang.'_signature'];

		$model=$this->loadModel($id);

		$pics=array();
		$photos="";
		$ulang=Yii::app()->user->getLanguage();
		if($lang=="ru"){
			Yii::app()->setLanguage("ru");
			$lang="ru";
		}else{
			Yii::app()->setLanguage("uk_ua");
			$lang="ua";
		}

		$auth=Authority::model()->findByPk(array('id'=>$auth,'lang'=>$lang));

		$pics=array_keys($_POST['chpk']);
		setlocale(LC_ALL, 'ru_RU.UTF-8');

		$photos = "";
		$pnum=1;
		$images=array();

		$model=$this->loadModel($id);
		if(count($model->requests_user)>0){$first=1;}else{$first=0;}
		if($first!=0){
			$pictures=$hole->pictures_fresh;
		}else{
			$pictures=$answ->files_img;
			$picPath=$model->requests_user[0]->answer->filesFolder.'/';
		}
			if($_POST['map_ch']==="on"){
				$photos =$photos."<tr><td colspan=2>".Yii::t('holes_view', 'Карта').' '.Yii::t('holes_view', 'PICTURE_TO').' №'.$id.'<br><img height="500px" src="http://maps.googleapis.com/maps/api/staticmap?center='.str_replace(',','.',$model->LATITUDE).','.str_replace(',','.',$model->LONGITUDE).'&zoom=14&size=400x400&markers=color:red%7Clabel:Дефект%7Cicon:http://ukryama.com/images/st1234/'.$model->type->alias.'_'.$model['STATE'].'.png|'.str_replace(',','.',$model->LATITUDE).','.str_replace(',','.',$model->LONGITUDE).'&sensor=false"></td></tr><tr><td colspan=2 class="smv-spacer"></td></tr>'."\n";
			}
				foreach($model->pictures_fresh as $picture){
					$pid = $picture->id;
					foreach($pics as $pic){
						if($pic==$pid){
							if(!$first){
								$pfile=$picture->original;
								$image=Yii::app()->image->load(Yii::getPathOfAlias('webroot').$pfile);

								if($image->__get("height")>$image->__get("width")){
									$image->rotate(-90);
									$fname=$pfile;

									preg_match('/[^?]*/', $fname, $matches);
								        $string = $matches[0];
									$pattern = preg_split('/\./', $string, -1, PREG_SPLIT_OFFSET_CAPTURE);
								        $filenamepart = $pattern[count($pattern)-1][0];
									preg_match('/[^?]*/', $filenamepart, $matches);
									$lastdot = $pattern[count($pattern)-1][1];
									$filename = substr($string, 0, $lastdot-1);
								        $pfile=$filename.".rotated.".$matches[0];
									$image->save(Yii::getPathOfAlias('webroot').$pfile);
								}
								if($request->html){
									$photos =$photos."<tr><td colspan=2>".Yii::t('holes_view', 'PICTURE').' '.$pnum.' '.Yii::t('holes_view', 'PICTURE_TO').' №'.$id.'<br><img height="500px" src="'.$pfile.'"></td></tr><tr><td colspan=2 class="smv-spacer"></td></tr>'."\n";
								}else{
									$photos =$photos."<tr><td colspan=2>".Yii::t('holes_view', 'PICTURE').' '.$pnum.' '.Yii::t('holes_view', 'PICTURE_TO').' №'.$id.'<br><img height="500px" src="data:image/jpg;base64,'.base64_encode(file_get_contents(Yii::getPathOfAlias('webroot').$pfile)).'"></td></tr><tr><td colspan=2 class="smv-spacer"></td></tr>'."\n";
								}
							}else{
								$pfile=$picPath.$picture->file_name;
								if($request->html){
									$photos =$photos."<tr><td colspan=2>".Yii::t('holes_view', 'PICTURE').' '.$pnum.' '.Yii::t('holes_view', 'PICTURE_TO').' №'.$id.'<br><img height="500px" src="'.$pfile.'"></td></tr><tr><td colspan=2 class="smv-spacer"></td></tr>'."\n";
								}else{
									$photos =$photos."<tr><td colspan=2>".Yii::t('holes_view', 'PICTURE').' '.$pnum.' '.Yii::t('holes_view', 'PICTURE_TO').' №'.$id.'<br><img height="500px" src="data:image/jpg;base64,'.base64_encode(file_get_contents(Yii::getPathOfAlias('webroot').$pfile)).'"></td></tr><tr><td colspan=2 class="smv-spacer"></td></tr>'."\n";
								}

							}
						$pnum++;
						}
					}
				}

 				$formType = "";
				$first_auth = "";
				$sent_date = "";
				$delivery_date = "";
				if($defect_type < 30 ){ // обычный дефект
	                                $formType=$model->type['alias'];
				}else{ // повторное обжалование - дефект типа незаконного ответа, неответа
					$fType=$model->type->findByPk(array("id"=>$defect_type,"lang"=>$lang));
					$formType = $fType->alias;

					$requests=$model->requests;
					$req=false;
					if(count($requests)>0){
						$req=$requests[0];
						$sent_date = $req->date_sent;
					}
					$delivery_date = $model->request_sent[0]->ddate;
					$nauth= new Authority;
					$fType = $nauth->findByPk(array("id"=>$first_authid,"lang"=>$lang));
					$first_auth = $fType->name;
				}

		$_data = array(
			"ref" => "$id",
			"to_name" =>$to_name,
			"to_address"=>$to_address,
			"from_name"=>$from,
			"first_auth"=>$first_auth,
			"sent_date"=>date("Y-m-d", $sent_date),
			"delivery_date"=>$delivery_date,
			"from_address"=>$postaddress,
			"when"=>strftime("%e ".Yii::t('month', date("n"))." %Y", $model->DATE_CREATED ? $model->DATE_CREATED : time()),
			"where"=>$model->ADDRESS,
			"date"=>strftime("%e ".Yii::t('month', date("n"))." %Y", time()),
			"init"=>$signature,
			"c_photos"=>count($pics),
			"files"=>$photos,
			"map"=>1
		);
//  			foreach ($_data as $dt) echo $dt."<br>";


//				$formType=$model->type['alias'];

				$name="$formType"."_$lang";

				$printer = Yii::app()->Printer;

				$tpl_base_name = YiiBase::getPathOfAlias($printer->params['templates'])."/dyplates/".$auth->atype->alias."_";
				$tplname = $tpl_base_name.$name.".php";
				$cssfilename = $tpl_base_name.$formType.".css";


				if($_POST['print']=="HTML")
				{
					header('Content-Type: text/html; charset=utf8', true);
					$css = file_get_contents($cssfilename); 
					$html = $this->renderFile($tplname,$_data,true);
					$html = "<style>$css</style>\n$html";
					echo $html;
					return;
				}//end print html
				else
				{//print pdf
					if(file_exists($tplname)){
						$css = file_get_contents($cssfilename); 
						$html = $this->renderFile($tplname,$_data,true);
						$outname="ukryama-".date("Y-m-d_G-i-s");
						echo $printer->printH2P($html, $css, $outname);
						return;
					}
				}//end print pdf

	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	   $this->pageTitle = Yii::t('titles', 'HOLES_INDEX');
		$this->layout='//layouts/header_default';
		
		$model=new Holes('search');		
		
		$model->unsetAttributes();  // clear any default values
		$model->PREMODERATED=1;
		if(isset($_POST['Holes']) || isset($_GET['Holes']))
			$model->attributes= Yii::app()->request->getParam('Holes');
		$dataProvider=$model->search();

		$this->render('index',array(
			'model'=>$model,
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionModerate($id) // на первый взгляд оооочень корявая и неоптимальная функция
	{
		if (!isset($_GET['PREMODERATE_ALL'])){
			$model=$this->loadModel($id);
			if (!$model->PREMODERATED) {
				$model->PREMODERATED=1;
				if(isset($_GET['ajax'])){
					if ($model->update())  {
						echo "ok";
						if ($model->ROAD_TYPE == 'highway') {
							$this->sendMailToUkrautodor($model);
						} 
						$this->sendMailToSai($model);
						$this->sendMessage($model, "moderated", $this->user);
					}
				}else{
					if ($model->update()) {
						if ($model->ROAD_TYPE == 'highway') {
							$this->sendMailToUkrautodor($model);
						}
						$this->sendMailToSai($model);
						$this->sendMessage($model, "moderated", $this->user);
						$this->redirect($_SERVER['HTTP_REFERER']);
					}
				}
			}
			elseif (isset($_GET['ajax']) && $_GET['ajax']=='holes-grid'){
				$model->PREMODERATED=0;
				if ($model->update()) echo 'ok';	
			}
		}
		else {
			$holes=Holes::model()->findAll('id IN ('.$_GET['PREMODERATE_ALL'].')');
			$ok=0;
			foreach ($holes as $model) if (!$model->PREMODERATED) {
				$model->PREMODERATED = 1;
				if ($model->update()) {
					if ($model->ROAD_TYPE == 'highway') {
						$this->sendMailToUkrautodor($model);
					}
					$this->sendMailToSai($model);
					$this->sendMessage($model, "moderated", $this->user);
					$ok++;
				}
			}
			if ($ok==count($holes))  echo 'ok';
		}
	}

	public function trackMail($id){
		$http=new Http;
		$url="http://services.ukrposhta.ua/barcodesingle/default.aspx?ctl00%24centerContent%24scriptManager=ctl00%24centerContent%24scriptManager%7Cctl00%24centerContent%24btnFindBarcodeInfo&__EVENTTARGET=&__EVENTARGUMENT=&ctl00%24centerContent%24txtBarcode=$id&__ASYNCPOST=true&ctl00%24centerContent%24btnFindBarcodeInfo=%D0%9F%D0%BE%D1%88%D1%83%D0%BA";
		$a= $http->http_request(array('url'=>$url,'return'=>'array', 'cookie'=>true));
		$cookie = $a['headers']['SET-COOKIE'];
		$url="http://services.ukrposhta.ua/barcodesingle/DownloadInfo.aspx";
		$data= $http->http_request(array('url'=>$url, 'cookie'=>$cookie));
		
		$page=preg_split("\n",$data);
		$print=0;
		foreach($page as $line){
			if($print){
				$result=strip_tags($line)."\n";
				$print=0;
			}
			if(strstr("$line","divInfo")){
				if(strstr("$line","</div>")){
					$result= strip_tags($line)."\n";
				}else{
					$print=1;
				}
			}
		}
		if(strstr($result,"вручене за довіреністю")){
			return date("Y-m-d",strtotime(mb_substr(strstr($result,"вручене за довіреністю "),23,10,'UTF-8')));
		}else{
			return 0;
		}
	}	
	public function actionTrackMail($id){
		$date=$this->trackMail($id);
		echo $date;
	}	

	public function actionSent($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['auth'])){
			$auth=$_POST['auth'];
		}else{
			$auth=$_POST['auth2'];
		}
		$ref=$_POST['ref'];
		if(isset($_POST['when'])){
			if(strlen($_POST['when'])>0){
				$date= $_POST['when'];
				if($_POST['mailtype']==1){
					$hrs = new HoleRequestSent;
					$hrs->hole_id=$id;
					$hrs->user_id=Yii::app()->user->id;
					$hrs->status=1;
					$hrs->ddate=$date;

					$date= strtotime($date);
					$hrs->req=$model->sendRequest($date,$auth,$ref);
					$hrs->save();
				}else{
					$hrs = new HoleRequestSent;
					$hrs->status=2;
					$hrs->user_id=Yii::app()->user->id;
					$hrs->hole_id=$id;

					$date= strtotime($date);
					$hrs->req=$model->sendRequest($date,$auth,$ref);

					$hrs->save();
				}
			}else{
				//do nothing
			}
		}elseif(strlen($_POST['when2'])>0){
		}else{
			//do nothing
		}

		if(isset($_POST['holesent'])){
			$data=$_POST['holesent'];
			$data['hole']=$id;
			$data['user']=Yii::app()->user->id;
			$hrs = new HoleRequestSent;

			$date= strtotime($_POST['when2']);
			$hrs->req=$model->sendRequest($date,$auth,$ref);
			$hrs->user_id=$data['user'];
			$hrs->rcpt=$data['rcpt'];
			$hrs->mailme=$data['mailme'];
			$hrs->hole_id=$data['hole'];
			$date=$this->trackMail($data['rcpt']);
			if($date){
				$hrs->status=1;
				$hrs->ddate=$date;
			}else{
				$hrs->status=0;
			}
			$hrs->save();
			$admin_id = 228;
			$owner_id = $model->user->id; // власник ями. Тут би ще з'ясувати відправника, бо лише відправник може завантажувати, аби йому не відправляти
			$mesg1 = $this->renderPartial('application.views.ugmail.sent-request',
   	  		      Array( 'model' => $model, 'request' => $model->request_last), true);
                               Messenger::send($admin_id, "УкрЯма: скарга відправлена", $mesg1);
                               Messenger::send($owner_id, "УкрЯма: скарга відправлена", $mesg1);

		}
			if(!isset($_GET['ajax']))
				$this->redirect(array('view','id'=>$model->ID));
	}
	
	public function actionNotsent($id)
	{
		$model=$this->loadModel($id);
		$model->updateRevoke();
			if(!isset($_GET['ajax']))
				$this->redirect(array('view','id'=>$model->ID));
	}	
	
	//удаление изображения
	public function actionDelpicture($id)
	{
			$picture=HolePictures::model()->findByPk((int)$id);
			
			if (!$picture)
				throw new CHttpException(404,'The requested page does not exist.');
				
			if ($picture->user_id!=Yii::app()->user->id && Yii::app()->user->level < 80 && $picture->hole->USER_ID!=Yii::app()->user->id)
				throw new CHttpException(403,'Доступ запрещен.');
				
			$picture->delete();			
			
			if(!isset($_GET['ajax']))
				$this->redirect(array('view','id'=>$picture->hole->ID));
		
	}		
	
	//удаление файла ответа гибдд
	public function actionDelanswerfile($id)
	{
			$file=HoleAnswerFiles::model()->findByPk((int)$id);
			
			if (!$file)
				throw new CHttpException(404,'The requested page does not exist.');
				
			if ($file->answer->request->user_id!=Yii::app()->user->id && !Yii::app()->user->isModer && $file->answer->request->hole->STATE !=Holes::STATE_GIBDDRE)
				throw new CHttpException(403,'Доступ запрещен.');
				
			$file->delete();			
			
			if(!isset($_GET['ajax']))
				$this->redirect(array('view','id'=>$file->answer->request->hole->ID));
		
	}	
	
	public function actionPersonal()
	{
		$this->layout='//layouts/header_user';
        $this->pageTitle = Yii::t('titles', 'HOLES_PERSONAL');
		$model=new Holes('search');
		$model->unsetAttributes();  // clear any default values
		$user=$this->user;
		
		if(isset($_POST['Holes']) || isset($_GET['Holes']))
			$model->attributes=isset($_POST['Holes']) ? $_POST['Holes'] : $_GET['Holes'];
		
      $cs=Yii::app()->getClientScript();
      $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/holes_list.css');        
      $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/hole_view.css');
      $cs->registerScriptFile(CHtml::asset($this->viewPath.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'holes_selector.js'));
      $cs->registerScriptFile('http://www.vertstudios.com/vertlib.min.js');        
      $cs->registerScriptFile(CHtml::asset($this->viewPath.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'StickyScroller'.DIRECTORY_SEPARATOR.'StickyScroller.min.js'));
		$cs->registerScriptFile(CHtml::asset($this->viewPath.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'StickyScroller'.DIRECTORY_SEPARATOR.'GetSet.js'));
		//$holes=Array();
		//$all_holes_count=0;		
			
		$this->render('personal',array(
			'model'=>$model,
			'user'=>$user
		));
	}
	//разобраться со значением функции
	public function actionSelectHoles($del=false)
	{
		$gibdds=Array();
		$del=filter_var($del, FILTER_VALIDATE_BOOLEAN);	
		if (isset($_POST['holes'])) $holestr=$_POST['holes'];
		else $holestr=''; 
		if ($holestr=='all' && $del) {
			Yii::app()->user->setState('selectedHoles', Array());
			//Yii::app()->end();
			}
		else{	
			$holes=explode(',',$holestr);
			for ($i=0;$i<count($holes);$i++) {$holes[$i]=(int)$holes[$i]; if(!$holes[$i]) unset($holes[$i]);}
			
			$selected=Yii::app()->user->getState('selectedHoles', Array());
			if (!$del){
				$newsel=array_diff($holes, $selected);
				$selected=array_merge($selected, $newsel);
			}
			else {	
				$newsel=array_intersect($selected, $holes);
				foreach ($newsel as $key=>$val) unset($selected[$key]);
			}
			Yii::app()->user->setState('selectedHoles', $selected);

				if ($selected) $gibdds=GibddHeads_ua::model()->with('holes')->findAll('holes.id IN ('.implode(',',$selected).')');

		}
		$this->renderPartial('_selected', Array('gibdds'=>$gibdds,'user'=>Yii::app()->user->userModel));
		
		//print_r(Yii::app()->user->getState('selectedHoles'));
	}	
	
	public function actionMyarea()
	{
	    $this->pageTitle = Yii::t('titles', 'HOLES_AREA');
		$user=Yii::app()->user;
		$area=$user->userModel->hole_area;
		if (!$area)	$this->redirect(array('/profile/myarea'));
		
		$this->layout='//layouts/header_user';
	
		$model=new Holes('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_POST['Holes']) || isset($_GET['Holes']))
			$model->attributes=isset($_POST['Holes']) ? $_POST['Holes'] : $_GET['Holes'];
		
		
		$cs=Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/holes_list.css');
		$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/hole_view.css');
        $cs->registerScriptFile(CHtml::asset($this->viewPath.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'holes_selector.js'));
		$cs->registerScriptFile('http://www.vertstudios.com/vertlib.min.js');        
        $cs->registerScriptFile(CHtml::asset($this->viewPath.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'StickyScroller'.DIRECTORY_SEPARATOR.'StickyScroller.min.js'));
		$cs->registerScriptFile(CHtml::asset($this->viewPath.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'StickyScroller'.DIRECTORY_SEPARATOR.'GetSet.js'));	     
		
		$holes=Array();
		$all_holes_count=0;		
					
		$this->render('myarea',array(
			'model'=>$model,
			'user'=>$user,
			'area'=>$area
		));
	}		
	
	public function actionMap2()
	{
		$this->layout='//layouts/header_blank';
	
		$model=new Holes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['Holes']))
			$model->attributes=$_POST['Holes'];
			if ($model->ADR_CITY=="Город") $model->ADR_CITY='';
			
		$this->render('map',array(
			'model'=>$model,
			'types'=>HoleTypes::model()->findAll(Array('condition'=>'t.published=1 and t.lang="ua"')),
		));
	}
	public function actionMap()
	{
		$this->layout='//layouts/header_blank';
	
		$model=new Holes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['Holes']))
			$model->attributes=$_POST['Holes'];
			if ($model->ADR_CITY=="Город") $model->ADR_CITY='';

		$hole = new Holes;
		//выставляем центр на карте по координатам IP юзера
		$request = new CHttpRequest;
		$geoIp = new EGeoIP();
		$geoIp->locate($request->userHostAddress); 	
		//echo ($request->userHostAddress);
		if ($geoIp->longitude) $hole->LATITUDE=$geoIp->longitude;
		if ($geoIp->latitude) $hole->LONGITUDE=$geoIp->latitude;

		$this->render('map',array(
			'model'=>$model,
			'hole'=>$hole,
			'types'=>HoleTypes::model()->findAll(Array('condition'=>'t.published=1 and t.lang="ua"')),
		));
	}
	public function actionAjaxMap()
	{
		$criteria=new CDbCriteria;
		/// Фильтрация по масштабу позиции карты
		
		if (isset($_GET['zoom'])) $ZOOM=$_GET['zoom'];
		else $ZOOM=14;
		
		if ($ZOOM < 3) { $_GET['left']=-190; $_GET['right']=190;}

		if (!isset ($_GET['bottom']) || !isset ($_GET['left']) || !isset ($_GET['right']) || !isset ($_GET['top'])) Yii::app()->end();
		
		if (isset ($_GET['bottom'])) $criteria->addCondition('LATITUDE > '.(float)$_GET['bottom']);
		if (isset ($_GET['left'])) $criteria->addCondition('LONGITUDE > '.(float)$_GET['left']);	 	
		if (isset ($_GET['right'])) $criteria->addCondition('LONGITUDE < '.abs((float)$_GET['right']));		
		if (isset ($_GET['top'])) $criteria->addCondition('LATITUDE < '.abs((float)$_GET['top']));		
		if (isset ($_GET['exclude_id']) && $_GET['exclude_id']) $criteria->addCondition('ID != '.(int)$_GET['exclude_id']); 
		if (!Yii::app()->user->isModer) $criteria->compare('PREMODERATED',1);
	
		/// Фильтрация по состоянию ямы
		if(isset($_GET['Holes']['STATE']) && $_GET['Holes']['STATE'])
		{
			$criteria->addInCondition('STATE', $_GET['Holes']['STATE']);
		}
		
		/// Фильтрация по типу ямы
		if(isset($_GET['Holes']['type']) && $_GET['Holes']['type'])
		{
			$criteria->addInCondition('TYPE_ID', $_GET['Holes']['type']);
		}
		
		$criteria->with=Array('type');
		
		$markers = Holes::model()->findAll($criteria);	
		

		
		if ($ZOOM >=14) $ZOOM=30;
				
		$singleMarkers = array();
		$clusterMarkers = array();
		
		// Minimum distance between markers to be included in a cluster, at diff. zoom levels
		$DISTANCE = (7000000 >> $ZOOM) / 100000;
		
		// Loop until all markers have been compared.
		while (count($markers)) {
			$marker  = array_pop($markers);
			$cluster = array();
		
			// Compare against all markers which are left.
			foreach ($markers as $key => $target) {
				$pixels = abs($marker->LONGITUDE-$target->LONGITUDE) + abs($marker->LATITUDE-$target->LATITUDE);
		
				// If the two markers are closer than given distance remove target marker from array and add it to cluster.
				if ($pixels < $DISTANCE) {
					unset($markers[$key]);
					$cluster[] = $target;
				}
			}
		
			// If a marker has been added to cluster, add also the one we were comparing to.
			if (count($cluster) > 0) {
				$cluster[] = $marker;
				$clusterMarkers[] = $cluster;
			} else {
				$singleMarkers[] = $marker;
			}
		}
		
		
		$markers=Array();
		foreach($singleMarkers as &$hole)
		{
			if(!isset($_REQUEST['skip_id']) || $_REQUEST['skip_id'] != $hole['ID'])
			{
				$markers[]=Array('id'=>$hole->ID, 'type'=>$hole->type->alias, 'lat'=>$hole->LONGITUDE, 'lng'=>$hole->LATITUDE, 'state'=>$hole->STATE);				
			}
		}
		
		$clusters=Array();
		foreach($clusterMarkers as $markerss)
		{
			$lats=Array();
			$lngs=Array();
				foreach($markerss as &$hole)
					{
						$lats[]=$hole->LONGITUDE;
						$lngs[]=$hole->LATITUDE;
					}
			sort($lats);
			sort($lngs);
			$center_lat=($lats[0]+$lats[count($lats)-1])/2;
			$center_lng=($lngs[count($lngs)-1]+$lngs[0])/2;
			
			
				$clusters[]=Array('count'=>count($markerss), 				
				'lat'=>$center_lat, 'lng'=>$center_lng, 
				);				
				
		}
//		echo $_GET['jsoncallback'].'({"clusters": '.CJSON::encode($clusters).', "markers": '.CJSON::encode($markers).' })';
		echo '{"clusters": '.CJSON::encode($clusters).', "markers": '.CJSON::encode($markers).' }';
		
		
		Yii::app()->end();		
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	   $this->pageTitle = Yii::t('titles', 'HOLES_DMAIN');
		
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}
		
		$this->layout='//layouts/header_user';
		$model=new Holes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Holes']))
			$model->attributes=$_GET['Holes'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionItemsSelected()
	{
	if (isset ($_POST['submit_mult']) && isset($_POST['itemsSelected'])) {
		if ($_POST['submit_mult']=='Удалить'){
			foreach ( $_POST['itemsSelected'] as $id){
				$model=Holes::model()->findByPk((int)$id);
				if ($model) $model->delete();
			}
		}

		if ($_POST['submit_mult']=='Отмодерировать'){
			foreach ( $_POST['itemsSelected'] as $id){
				$model=Holes::model()->findByPk((int)$id);
				if ($model) {
				$model->PREMODERATED=1;
				$model->update();
				}
			}
		}

		if ($_POST['submit_mult']=='Демодерировать'){
			foreach ( $_POST['itemsSelected'] as $id){
				$model=Holes::model()->findByPk((int)$id);
				if ($model) {
				$model->PREMODERATED=0;
				$model->update();
				}
			}
		}
    }
		if (!isset($_GET['ajax'])) $this->redirect($_SERVER['HTTP_REFERER']);
	}	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Holes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	//Лоадинг модели для пользовательских изменений
	public function loadChangeModel($id)
	{
		$model=Holes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		elseif(!$model->IsUserHole && !Yii::app()->user->level>80)	
			throw new CHttpException(403,'Доступ запрещен.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='holes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/**
	 * Sends hole notification email to Ukrautodor.
	 */
	protected function sendMailToUkrautodor($hole)
	{
		$headers = "MIME-Version: 1.0\r\nFrom: " . Yii::app()->params['adminEmail'] . "\r\nReply-To: " . Yii::app()->params['adminEmail'] . "\r\nContent-Type: text/html; charset=utf-8";
		Yii::app()->request->baseUrl = Yii::app()->request->hostInfo;

		$mailbody = $this->renderPartial(
			'application.views.ugmail.ukrautodor',
			Array(
				'model' => $hole,
			),
			true
		);

		return mail(Yii::app()->params['ukrautodorEmail'], 'УкрЯма: добавлена яма', $mailbody, $headers);
	}

	/**
	 * Sends hole notification email to State Automodule Inspection.
	 */
	protected function sendMailToSai($hole)
	{
        $dep = Authority::model()->find(array(
            'select'=>'o_email',
            'condition'=>'region_id=:region_id and lang=:lang',
            'params' => array(':region_id' => $hole->region_id, ':lang'=>'ua')
        ));

        if($dep->o_email){
            $email = $dep->o_email;
        }else{
            $email = Yii::app()->params['saiEmail'];
        }


		$headers = "MIME-Version: 1.0\r\nFrom: " . Yii::app()->params['adminEmail'] . "\r\nReply-To: " . Yii::app()->params['adminEmail'] . "\r\nContent-Type: text/html; charset=utf-8";
		Yii::app()->request->baseUrl = Yii::app()->request->hostInfo;

		$mailbody = $this->renderPartial(
			'application.views.ugmail.sai',
			Array(
				'model' => $hole,
			),
			true
		);

		return mail($email, 'Повідомлення по порушення законодавства', $mailbody, $headers);
	}

	/**
	 * Sends event notification to the User
	 */
	public function sendMessage($hole, $event, $user)
	{
		$headers = "MIME-Version: 1.0\r\nFrom: " . Yii::app()->params['adminEmail'] . "\r\nReply-To: " . Yii::app()->params['adminEmail'] . "\r\nContent-Type: text/html; charset=utf-8";
		Yii::app()->request->baseUrl = Yii::app()->request->hostInfo;

		$mailbody = "";
		$subj = "Empty - Unknown";
		$email = ''; // Yii::app()->params['moderatorEmail'];
		switch(strtolower($event)){
			case "add": // добавлена яма. Нужно уведомить модератора
				{
				   $subj = 'УкрЯма: добавлена яма';
				}
			case "moderated": // ям отмодерирована. Нужно уведомить пользователя и предложить отправить по почте или заплатить
				{
				  $mailbody = $this->renderPartial(
				   'application.views.ugmail.moderated',
	   	  		   Array( 'model' => $hole, ), true);
				   $email = $hole->user->email;
				   $subj = 'УкрЯма: яма опублікована';

				}
		}

		if ($email != '') {
			return mail($email, $subj, $mailbody, $headers);
		}
	}

    /*
     * Функція для перевертання зображення
     * Використовується в \protected\views\holes\view.php
     * Return: bool
     * Poremhuck Evgeniy 2015
     */
    public function actionRotate($image,$holeid){
        
        $degrees = 180;

        $patches = array(
            YiiBase::getPathOfAlias("webroot")."\\upload\\st1234\\medium\\".$holeid."\\".$image, // Шлях до оригінального зображення
            YiiBase::getPathOfAlias("webroot")."\\upload\\st1234\\small\\".$holeid."\\".$image, //  Шлях до мініатюри
                    );

        foreach($patches as $patch) {

            $src = $patch;

            $extension = explode(".", $src);

            if (preg_match("/jpg|jpeg/", $extension[2])) {

                $src_img = imagecreatefromjpeg($src);
            }

            if (preg_match("/png/", $extension[2])) {

                $src_img = imagecreatefrompng($src);
            }

            if (preg_match("/gif/", $extension[2])) {

                $src_img = imagecreatefromgif($src);
            }

            $rotate = imagerotate($src_img, $degrees, 0);

            if (preg_match("/png/", $extension[2])) {
                imagepng($rotate, $patch);
            } else if (preg_match("/gif/", $extension[2])) {
                imagegif($rotate, $patch);
            } else {
                imagejpeg($rotate, $patch);
            }

            imagedestroy($rotate);
            imagedestroy($src_img);

            return true;
        }

    }
}