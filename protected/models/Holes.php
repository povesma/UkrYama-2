<?php

/**
 * This is the model class for table "{{holes}}".
 *
 * The followings are the available columns in table '{{holes}}':
 * @property string $ID
 * @property string $USER_ID
 * @property double $LATITUDE
 * @property double $LONGITUDE
 * @property string $ADDRESS
 * @property string $STATE
 * @property string $DATE_CREATED
 * @property string $DATE_STATUS
 * @property string $COMMENT1
 * @property string $COMMENT2
 * @property string $TYPE_ID
 * @property string $region_id
 * @property string $ADR_CITY
 * @property integer $PREMODERATED
 */
class Holes extends CActiveRecord
{
   const STATE_FRESH = 'fresh';
   const STATE_INPROGRESS = 'inprogress';
   const STATE_FIXED = 'fixed';
	/**
	 * Returns the static model of the specified AR class.
	 * @return Holes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public $DATE_FIRST_SENT; 	
	public $WAIT_DAYS; 	
	public $PAST_DAYS;	
	public $NOT_PREMODERATED;	
//	public $STR_SUBJECTRF;
	public $deletepict=Array();
	public $counts;
	public $state_to_filter;
	public $time;
	public $limit;
	public $offset=0;
	public $type_alias;
	public $showUserHoles;
	public $username;
	public $FIRST_NAME;
	public $LAST_NAME;
	public $EMAIL;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{holes}}';
	}
	
	public $ADR_CITY='Город';
	
	public function getParams(){
		return array(
					'big_sizex'      => 1024,
					'big_sizey'      => 1024,
					'medium_sizex'   => 600,
					'medium_sizey'   => 450,
					'small_sizex'    => 240,
					'small_sizey'    => 160,
					'premoderated'   => 0,
					'min_delay_time' => 60
		);
	}	

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USER_ID, LATITUDE, LONGITUDE, ADDRESS, DATE_CREATED, TYPE_ID', 'required'),
			array('PREMODERATED, TYPE_ID, NOT_PREMODERATED, createdate, updatedate', 'numerical', 'integerOnly'=>true),
			array('LATITUDE, LONGITUDE', 'numerical'),
			array('USER_ID, STATE, DATE_CREATED, DATE_STATUS', 'length', 'max'=>10),
			array('ADR_CITY', 'length', 'max'=>70),
//			array('STR_SUBJECTRF, username', 'length'),
			array('COMMENT1, COMMENT2, deletepict, upploadedPictures, showUserHoles', 'safe'),	
			array('upploadedPictures', 'file', 'types'=>'jpg, jpeg, png, gif','maxFiles'=>10, 'allowEmpty'=>true, 'on' => 'update, import, fix'),
			array('upploadedPictures', 'file', 'types'=>'jpg, jpeg, png, gif','maxFiles'=>10, 'allowEmpty'=>false, 'on' => 'insert'),
         
         array('DATE_CREATED', 'compare', 'compareValue'=>time(), 'operator'=>'<=', 'allowEmpty'=>false , 
            'message'=>Yii::t('template', 'DATE_CANT_BE_FUTURE'),
         ),
         /*array('DATE_CREATED', 'compare', 'compareValue'=>time() - (7 * 86400), 'operator'=>'>', 'allowEmpty'=>false , 
            'message'=>Yii::t('template', 'DATE_CANT_BE_PAST'),
         ),*/

         
			//array('upploadedPictures', 'required', 'on' => 'insert', 'message' => 'Необходимо загрузить фотографии'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, USER_ID, LATITUDE, LONGITUDE, ADDRESS, STATE, DATE_CREATED, DATE_STATUS, COMMENT1, COMMENT2, TYPE_ID, ADR_CITY, PREMODERATED', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'subject'=>array(self::BELONGS_TO, 'Region', 'region_id'),
			'requests'=>array(self::HAS_MANY, 'HoleRequests', 'hole_id'),
			'pictures'=>array(self::HAS_MANY, 'HolePictures', 'hole_id', 'order'=>'pictures.type, pictures.ordering'),
			'pictures_fresh'=>array(self::HAS_MANY, 'HolePictures', 'hole_id', 'condition'=>'pictures_fresh.type="fresh"','order'=>'pictures_fresh.ordering'),
			'pictures_fixed'=>array(self::HAS_MANY, 'HolePictures', 'hole_id', 'condition'=>'pictures_fixed.type="fixed"','order'=>'pictures_fixed.ordering'),
			'user_pictures_fixed'=>array(self::HAS_MANY, 'HolePictures', 'hole_id', 'condition'=>'user_pictures_fixed.type="fixed" AND user_pictures_fixed.user_id='.Yii::app()->user->id,'order'=>'user_pictures_fixed.ordering'),

			//not sent more than 3 days after creating
			'not_sent'=>array(self::HAS_MANY, 'HoleRequests', 'hole_id','condition'=>'not_sent.id is null and DATE(FROM_UNIXTIME(`date_created`)) < (curdate() - interval 3 day)'),

			'request_sent'=>array(self::HAS_MANY, 'HoleRequestSent', 'hole_id','order'=>'request_sent.ddate ASC'),
			'last_request_sent'=>array(self::HAS_ONE, 'HoleRequestSent', 'hole_id','order'=>'request_sent.ddate DESC'),
			'requests_user'=>array(self::HAS_MANY, 'HoleRequests', 'hole_id', 'condition'=>'requests_user.user_id='.Yii::app()->user->id,'order'=>'requests_user.id ASC'),
			'requests'=>array(self::HAS_MANY, 'HoleRequests', 'hole_id', 'order'=>'requests.id ASC'),
			'request_last'=>array(self::HAS_ONE, 'HoleRequests', 'hole_id', 'order'=>'request_last.id DESC'),
			'payments'=>array(self::HAS_MANY, 'Payments', 'hole_id', 'condition' => 'status = "success"', 'order'=>'payments.id ASC'),

			'fixeds'=>array(self::HAS_MANY, 'HoleFixeds', 'hole_id','order'=>'fixeds.date_fix DESC'),
			'user_fix'=>array(self::HAS_ONE, 'HoleFixeds', 'hole_id', 'condition'=>'user_fix.user_id='.Yii::app()->user->id),
			'type'=>array(self::BELONGS_TO, 'HoleTypes', 'TYPE_ID'),
			'user'=>array(self::BELONGS_TO, 'UserGroupsUser', 'USER_ID'),
			'selected_lists'=>array(self::MANY_MANY, 'UserSelectedLists',
               '{{user_selected_lists_holes_xref}}(hole_id,list_id)'),
            'comments_cnt'=> array(self::STAT, 'Comment', 'owner_id', 'condition'=>'owner_name="Holes" AND status < 2'),   
            'comments'=> array(self::HAS_MANY, 'Comment', 'owner_id', 'condition'=>'owner_name="Holes"'), 
         
		);
	}

      
	public function behaviors(){
      return array( 'CAdvancedArBehavior' => array(
         'class' => 'application.extensions.CAdvancedArBehavior'));
   }

	public static function getAllRoadTypes()
	{
		return array(
			'city' => Yii::t('holes','HOLES_ROAD_TYPE_CITY'),
			'highway' => Yii::t('holes','HOLES_ROAD_TYPE_HIGHWAY')
		);
	}

	public static function getAllstates()	{
   	$arr=Array();
   	$arr['fresh']      = Yii::t('holes','HOLES_STATE_FRESH_FULL');
   	$arr['inprogress'] = Yii::t('holes','HOLES_STATE_INPROGRESS_FULL');
   	$arr['fixed']      = Yii::t('holes','HOLES_STATE_FIXED_FULL');
   	return $arr;
	}
	
	public static function getAllstatesShort()	{
   	$arr=Array();
   	$arr['fresh']      = Yii::t('holes','HOLES_STATE_FRESH_SHORT');
   	$arr['inprogress'] = Yii::t('holes','HOLES_STATE_INPROGRESS_SHORT');
   	$arr['fixed']      = Yii::t('holes','HOLES_STATE_FIXED_SHORT');
   	return $arr;
	}	
	
	public static function getAllstatesMany()	{
   	$arr=Array();
   	$arr['fresh']      = Yii::t('holes','HOLES_STATE_FRESH_MANY');
   	$arr['inprogress'] = Yii::t('holes','HOLES_STATE_INPROGRESS_MANY');
   	$arr['fixed']      = Yii::t('holes','HOLES_STATE_FIXED_MANY');
	  return $arr;
	}	
	
	public function getStateName()	
	{	
		return $this->AllstatesShort[$this->STATE];
	}

	public function getRoadType()
	{
		$roadTypes = $this->getAllRoadTypes();
		return $roadTypes[$this->ROAD_TYPE];
	}
	
	public function getIsSelected()	
	{	
		foreach (Yii::app()->user->getState('selectedHoles', Array()) as $id) 
			if ($id==$this->ID) return true;
		return false;	
	}	
	
	public function getFixByUser($id)
	{
		foreach ($this->fixeds as $fix){
			if ($fix->user_id==$id) return $fix;
		}
		return null;
	}

	private $_files = array();

	public function getUpploadedPictures(){
	    if(empty($this->_files)){
		if(!empty($_FILES)){
		    foreach ($_FILES as $file){
			if(is_array($file['name'])){
			    error_log ("Count of files: ".count($file['name'])."\n", 3, "php-log.log");
			    error_log ("Contents: ".print_r($file,true)."\n", 3, "php-log.log");
			    for($i=0; $i < count($file['name']['upploadedPictures']); $i++){
				$f_name = $file['name']['upploadedPictures'][$i];
			  	error_log ("Filename: ".$f_name."\n", 3, "php-log.log");
				$this->_files []= $this->_getInstanseFromFile ([
				    'name' => $f_name, 
				    'tmp_name' => $file['tmp_name']['upploadedPictures'][$i], 
				    'type' => $file['type']['upploadedPictures'][$i], 
				    'size' => $file['size']['upploadedPictures'][$i], 
				    'error' => $file['error']['upploadedPictures'][$i]
				]);
			    }
			}else
			    $this->_files []= $this->_getInstanseFromFile($file);
		    }
		}
	    }
	    return $this->_files;
	}
	
	private function _getInstanseFromFile($fileInfo){
	    return new CUploadedFile( $fileInfo['name'], 
				    $fileInfo['tmp_name'], 
				    $fileInfo['type'], 
				    $fileInfo['size'], 
				    $fileInfo['error']);
	}
	
	public function countUpploadFiles(){
	    return count($this->_files);
	}
	
	public function savePictures(){				
		foreach ($this->deletepict as $pictid) {
			$pictmodel=HolePictures::model()->findByPk((int)$pictid);  
			if ($pictmodel)$pictmodel->delete();
		}

			$imagess = $this->getUpploadedPictures();

		//print_r($imagess);exit;
		$id=$this->ID;
		$prefix='';			
      $path = $_SERVER['DOCUMENT_ROOT'].Yii::app()->params['imagePath'];			
		if (!is_dir($path.'original/'.$id)){
			if(!mkdir($path.'original/'.$id))
			{
				$this->addError('upploadedPictures', Yii::t('errors', 'GREENSIGHT_ERROR_CANNOT_CREATE_DIR'));
				return false;
			}
			if(!mkdir($path.'medium/'.$id))
			{
				unlink($path.'original/'.$id);
				$this->addError('upploadedPictures',Yii::t('errors', 'GREENSIGHT_ERROR_CANNOT_CREATE_DIR'));
				return false;
			}
			if(!mkdir($path.'small/'.$id))
			{
				unlink($path.'original/'.$id);
				unlink($path.'medium/'.$id);
				$this->addError('upploadedPictures',Yii::t('errors', 'GREENSIGHT_ERROR_CANNOT_CREATE_DIR'));
				return false;
			}
		}						

		$_params=$this->params;
		$file_counter = 0;
		$k = $this->ID;			
						
        foreach ($imagess as $_file){
			if(!$_file->hasError)
			{	
				$imgname=rand().'.jpg';
				$image = $this->imagecreatefromfile($_file->getTempName(), $_image_info);
				if(!$image)
				{
					$this->addError('pictures',Yii::t('errors', 'GREENSIGHT_ERROR_UNSUPPORTED_IMAGE_TYPE'));
					return false;
				}
				$aspect = max($_image_info[0] / $_params['big_sizex'], $_image_info[1] / $_params['big_sizey']);
				if($aspect > 1)
				{
					$new_x    = floor($_image_info[0] / $aspect);
					$new_y    = floor($_image_info[1] / $aspect);
					$newimage = imagecreatetruecolor($new_x, $new_y);
					imagecopyresampled($newimage, $image, 0, 0, 0, 0, $new_x, $new_y, $_image_info[0], $_image_info[1]);
					imagejpeg($newimage, $path.'original/'.$id.'/'.$imgname);
				}
				else
				{
					imagejpeg($image, $path.'original/'.$id.'/'.$imgname);
				}
	
				$aspect   = max($_image_info[0] / $_params['medium_sizex'], $_image_info[1] / $_params['medium_sizey']);
				$new_x    = floor($_image_info[0] / $aspect);
				$new_y    = floor($_image_info[1] / $aspect);
				$newimage = imagecreatetruecolor($new_x, $new_y);
				imagecopyresampled($newimage, $image, 0, 0, 0, 0, $new_x, $new_y, $_image_info[0], $_image_info[1]);
				imagejpeg($newimage, $path.'medium/'.$id.'/'.$imgname);
				imagedestroy($newimage);
				$aspect   = min($_image_info[0] / $_params['small_sizex'], $_image_info[1] / $_params['small_sizey']);
				$newimage = imagecreatetruecolor($_params['small_sizex'], $_params['small_sizey']);
				imagecopyresampled
				(
					$newimage,
					$image,
					0,
					0,
					$_image_info[0] > $_image_info[1] ? floor(($_image_info[0] - $aspect * $_params['small_sizex']) / 2) : 0,
					$_image_info[0] < $_image_info[1] ? floor(($_image_info[1] - $aspect * $_params['small_sizey']) / 2) : 0,
					$_params['small_sizex'],
					$_params['small_sizey'],
					ceil($aspect * $_params['small_sizex']),
					ceil($aspect * $_params['small_sizey'])
				);
				imagejpeg($newimage, $path.'small/'.$id.'/'.$imgname);
				imagedestroy($newimage);
				imagedestroy($image);
							
				$imgmodel=new HolePictures;
				$imgmodel->type=$this->scenario=='fix'?'fixed':'fresh'; 
				$imgmodel->filename=$imgname;
				$imgmodel->hole_id=$this->ID;
				$imgmodel->user_id=Yii::app()->user->id;
				$imgmodel->ordering=$imgmodel->lastOrder+1;
				$imgmodel->save();
			}
		}
		return true;			
	}

	public static function imagecreatefromfile($file_name, &$_image_info = array())
	{
		$_image_info = getimagesize($file_name, $_image_additional_info);
		$_image_info['additional'] = $_image_additional_info;
		switch($_image_info['mime'])
		{
			case 'image/jpeg':
			case 'image/pjpg':
			{
				$operator = 'imagecreatefromjpeg';
				break;
			}
			case 'image/gif':
			{
				$operator = 'imagecreatefromgif';
				break;
			}
			case 'image/png':
			case 'image/x-png':
			{
				$operator = 'imagecreatefrompng';
				break;
			}
			default:
			{
				return false;
			}
		}
		return $operator($file_name);
	}	

	public function sendRequest($date,$auth,$ref){
			//echo "here";
			$request=new HoleRequests;
			$request->attributes=Array(
					'hole_id'=>$this->ID,
					'user_id'=>Yii::app()->user->id,
					'gibdd_id'=>$auth,
					'date_sent'=>$date,
					'ref'=>$ref,
					);
			if($request->save()) {$this->updateSetinprogress(); return $request->primaryKey;}else{return false;}
	}


	public function updateSetinprogress()
	{
		if($this->STATE != Holes::STATE_FRESH && !($this->STATE == Holes::STATE_FIXED && !sizeof($this->user_pictures_fixed)))
				{
					return false;
				}
		else {			
			if ($this->user_fix) $this->user_fix->delete();			
			if (count ($this->fixeds) == 0) {
					$this->DATE_STATUS=time();
					if($this->STATE == Holes::STATE_FRESH)  
					{
						$this->STATE = Holes::STATE_INPROGRESS;										
					}
				}
			if ($this->update()) return true;
			else return false;
		}	
	}
	
	public function updateRevoke()
	{
		$requests=$this->requests_user;
		$req=false;
		if(count($requests)>0){
			$req=$requests[count($requests)-1];
			$req->req_sent->delete();
			$req->delete();
			$reqall=$this->requests;
			if(count($reqall)==0) {
				$this->STATE = Holes::STATE_FRESH;
				$this->update();
			}
		}else{
			return false;
		}

	}		

	public function getFirstSentDate()
	{
		$requests=$this->requests; // это неправильно. Выбирается дата отправки, а не доставки!
		$req=false;
		if(count($requests)>0){
			$req=$requests[0];
			$this->DATE_FIRST_SENT = $req->date_sent;
			return $this->DATE_FIRST_SENT;
			
		}else{
			return false;
		}

	}

    /**
     * Функція повертає реальну кількість днів відведених законом "Про звернення громадян"
     * Якщо дефект не відправлено - поверає false
     * Використовується в \protected\views\holes\_viewrightpanel.php
     * @return bool|int
     *
     */
	public function daysWaitPast(){

           if($this->STATE != Holes::STATE_INPROGRESS || !$this->getFirstSentDate() || !$this->DATE_FIRST_SENT ) {

              return false;

           }else{

               return 31 - ceil((time() - $this->DATE_FIRST_SENT) / 86400);
           }
        }
	
/*	
	public function afterFind(){
		//вычисляем количество дней с момента отправки
		if(($this->STATE == Holes::STATE_INPROGRESS || $this->STATE == Holes::STATE_ACHTUNG) && $this->DATE_SENT && !$this->STATE != Holes::STATE_GIBDDRE)
		{
			$this->WAIT_DAYS = 31 - ceil((time() - $this->DATE_SENT) / 86400);	
		}
			
		//отмечаем яму если просроченна
		if ($this->WAIT_DAYS < 0 && $this->STATE == Holes::STATE_INPROGRESS) {
			$this->STATE = Holes::STATE_ACHTUNG;
			$this->update();
		}
		elseif ($this->STATE == Holes::STATE_ACHTUNG && $this->WAIT_DAYS > 0){
			$this->STATE = Holes::STATE_INPROGRESS;
			$this->update();			
		}
		
		if ($this->WAIT_DAYS<0) { 
			$this->PAST_DAYS=abs($this->WAIT_DAYS);
			$this->WAIT_DAYS=0;
		}		
	}
*/	
	public function beforeDelete(){
		//сначала удаляем все картинки
		foreach ($this->pictures as $picture) $picture->delete();			
		
		//Потом удаляем все запросы вместе со всем содержимым
		foreach ($this->requests as $request) $request->delete();
		
		//Потом все отметки об исправленности
		foreach ($this->fixeds as $fixed) $fixed->delete();
		
		$this->selected_lists=Array();
		$this->update();

		return true;
	}	
	
	public function beforeSave(){
		parent::beforeSave();
		if ($this->isNewRecord){
			//$this->USER_ID = Yii::app()->user->id;	
			$this->createdate = time();
		}
		$this->updatedate = time();

//		$this->ADR_CITY=trim($this->ADR_CITY);

		return true;
	}	
	
	public function getIsUserHole(){				
      if ($this->USER_ID==Yii::app()->user->id) 
         return true;
      else 
         return false;
	}	
	
	public function getmodering(){
		if ($this->PREMODERATED) {$publtext='снять модерацию'; $pubimg='published.png';}
		else {$publtext='отмодерировать';  $pubimg='unpublished.png';}
		return '<a class="publish ajaxupdate" title="'.$publtext.'" href="'.Yii::app()->getController()->CreateUrl("moderate", Array('id'=>$this->ID)).'">
			<img src="/images/'.$pubimg.'" alt="'.$publtext.'"/>
			</a>';
	}	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'USER_ID' => Yii::t('template', 'USER'),
			'LATITUDE' => Yii::t('template', 'LATITUDE'),
			'LONGITUDE' => Yii::t('template', 'LONGITUDE'),
			'ADDRESS' => Yii::t('template', 'DEFECT_ADDRESS'),
			'STATE' => Yii::t('holes', 'WIDGET_STATUS_DEFECT'),
			'createdate' => Yii::t('template', 'CREATEDATE'),
			'updatedate' => Yii::t('template', 'UPDATEDATE'),
			'DATE_CREATED' => Yii::t('template', 'DATE_CREATED'),
			'DATE_STATUS' => Yii::t('template', 'DATE_STATUS'),
			'COMMENT1' => Yii::t('template', 'COMMENTS'),
			'COMMENT2' => Yii::t('template', 'COMMENTS'),
			'FIRST_NAME' => Yii::t('template', 'FIRST_NAME'),
			'LAST_NAME' => Yii::t('template', 'LAST_NAME'),
			'EMAIL' => Yii::t('template', 'EMAIL'),
			'TYPE_ID' => Yii::t('holes', 'WIDGET_TYPE_DEFECT'),
			'region_id' => Yii::t('holes', 'WIDGET_DEFAULT_REGION'),
			'ADR_CITY' => Yii::t('holes', 'WIDGET_DEFAULT_CITY'),
			'PREMODERATED' => Yii::t('template', 'PREMODERATED'),
			'NOT_PREMODERATED' =>  Yii::t('template', 'NOT_PREMODERATED'),
         
            'deletepict'=> Yii::t('template', 'DELETEPICT'), 
			'replуfiles'=> Yii::t('template', 'INFO_REPLYFILES'), 
			'upploadedPictures'=>$this->scenario=='fix' ? Yii::t('template', 'INFO_UPLOADPICT_FIX') : Yii::t('template', 'INFO_UPLOADPICT'),
			'ROAD_TYPE' => Yii::t('holes', 'WIDGET_ROAD_TYPE'),
		);
	}
   
  
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function getisEmptyAttribs()	
	{
		$ret=true;
		foreach ($this->attributes as $attr){
			if($attr) $ret=false;
		}
		return $ret;

	}
	
	public function userSearch()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$userid=Yii::app()->user->id;
		$criteria=new CDbCriteria;
		//$criteria->with=Array('pictures_fresh','pictures_fixed');
		$criteria->with=Array('type','pictures_fresh', 'comments_cnt');
		$criteria->compare('t.ID',$this->ID,false);
		if (!$this->showUserHoles || $this->showUserHoles==1) $criteria->compare('t.USER_ID',$userid,false);
		elseif ($this->showUserHoles==2) {
			$criteria->with=Array('type','pictures_fresh','requests');
			$criteria->addCondition('t.USER_ID!='.$userid);
			$criteria->compare('requests.user_id',$userid,true);
			$criteria->together=true;
		}		
		$criteria->compare('t.STATE',$this->STATE,true);	
		$criteria->compare('t.TYPE_ID',$this->TYPE_ID,false);
		$criteria->compare('type.alias',$this->type_alias,true);	
		//
		//$criteria->addCondition('t.USER_ID='.$userid);
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				        'pageSize'=>$this->limit ? $this->limit : 12,				        
				    ),
			'sort'=>array(
			    'defaultOrder'=>'t.DATE_CREATED DESC',
				)
		));
	}	
	
	public function areaSearch($user)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		
		$area=$user->userModel->hole_area;
		
		$userid=$user->id;
		
		$criteria=new CDbCriteria;
                $criteria->with=Array('type','pictures_fresh', 'comments_cnt');	
		$criteria->compare('t.ID',$this->ID,false);

		foreach ($area as $shape){
			$criteria->addCondition('LATITUDE >= '.$shape->points[0]->lat
			.' AND LATITUDE <= '.$shape->points[2]->lat
			.' AND LONGITUDE >= '.$shape->points[0]->lng
			.' AND LONGITUDE <= '.$shape->points[2]->lng, 'OR');
			}

		if ($this->showUserHoles==1) $criteria->compare('t.USER_ID',$userid,false);
		elseif ($this->showUserHoles==2) {
			$criteria->with=Array('type','pictures_fresh','requests');
			$criteria->addCondition('t.USER_ID!='.$userid);
			$criteria->compare('requests.user_id',$userid,true);
			$criteria->together=true;
			}		
		$criteria->compare('t.STATE',$this->STATE,true);	
		$criteria->compare('t.TYPE_ID',$this->TYPE_ID,false);
		$criteria->compare('type.alias',$this->type_alias,true);	
		//
		//$criteria->addCondition('t.USER_ID='.$userid);
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				        'pageSize'=>$this->limit ? $this->limit : 12,				        
				    ),
			'sort'=>array(
			    'defaultOrder'=>'t.DATE_CREATED DESC',
				)
		));
	}	
	
	
	
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		//$criteria->with=Array('pictures_fresh','pictures_fixed');
		$criteria->with=Array('type','pictures_fresh', 'comments_cnt');
		$criteria->compare('t.ID',$this->ID,false);
		$criteria->compare('t.USER_ID',$this->USER_ID,false);
		$criteria->compare('t.LATITUDE',$this->LATITUDE);
		$criteria->compare('t.LONGITUDE',$this->LONGITUDE);
		$criteria->compare('t.ADDRESS',$this->ADDRESS,true);
		$criteria->compare('t.STATE',$this->STATE,true);
		$criteria->compare('t.DATE_CREATED',$this->DATE_CREATED,true);
		$criteria->compare('t.DATE_STATUS',$this->DATE_STATUS,true);
		$criteria->compare('t.COMMENT1',$this->COMMENT1,true);
		$criteria->compare('t.COMMENT2',$this->COMMENT2,true);
		$criteria->compare('t.TYPE_ID',$this->TYPE_ID,false);
		$criteria->compare('type.alias',$this->type_alias,true);
		$criteria->compare('t.ADR_CITY',$this->ADR_CITY,true);
		if ($this->NOT_PREMODERATED) $criteria->compare('PREMODERATED',0);
		if (!Yii::app()->user->isModer) $criteria->compare('PREMODERATED',$this->PREMODERATED,true);
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				        'pageSize'=>$this->limit ? $this->limit : 27,				        
				    ),
			'sort'=>array(
			    'defaultOrder'=>'t.ID DESC',
				)
		));
	}
	
	public function xmlSearch(){
	    $dataProvider = $this->search();
	    $dataProvider->pagination = false;	    
	    $dataProvider->criteria->with = [];
	    
	    $dataProvider->criteria->offset = (int) $this->offset;
	    $dataProvider->criteria->limit = (int) $this->limit;

	    return $dataProvider;
	}
	
	public function region(){
		$address=preg_split("/,/",$this->ADDRESS);
			$sub=$address[0];
			foreach ($address as $addrpart) {
				if(strpos($addrpart,"місто")){ // якщо десь між комами написано "місто"
					$sub=mb_substr($addrpart,6,20,'UTF-8');
					break;
				}
			}
			$name=mb_strtolower($sub,'UTF-8');
			$region=Region::model()->find('LOWER(name) like :name',array(':name'=>$name));
			if(strlen($region->id)>0) 
			{
				return $region;
			}else{
				$region=Region::model()->find('LOWER(name) like :name',array(':name'=>"%".$name."%"));
				return $region;
			}
//по "%Киев%" находит Киевская область
//			$region=Region::model()->find('LOWER(name) like :name',array(':name'=>"%".$name."%"));

	}
	public function getAllAuth($reg, $holetype, $lang){
//		echo "Searching for ".$holetype->alias." in ".$reg->name." for $lang<br>\n";exit;
		$result=array();
		foreach($holetype->arel as $trel){ //вызываем отношение в модели, которое возвращает список id типов органов, ответвтвенных за данный тип дефекта
			$res = $this->getAuthByType($reg, $trel->atype->id, $lang);
//			echo "Results: ".count($res)."<br>";
			if(count($res)){
				$result=array_merge($result,$res);
			}
		}
//		echo count($result);exit;
		return $result;
	}
	public function getAuthByType($reg,$authtype,$lang){
		$result=array();
		$auth=Authority::model()->findAll("region_id=:region and type=:type and lang=:lang", array(":region"=>$reg->id,":type"=>$authtype,':lang'=>$lang));
//		echo "Found ".count($auth)." of ".$authtype->alias." in ".$reg->name."<br>";
		if(count($auth)){//если в данном регионе найдены органы нужного нам типа, то записываем их в массив и возвращаем его
			foreach($auth as $au){
//				echo "Authority is: ".$au->name."<br>";
				array_push($result,$au);
			}
		}else{//иначе идем выше по регионам
			$regP=$reg->parent;//запрашиваем родительский регион
			if($regP !=null){
				if($regP->id > 0){
					$result=$this->getAuthByType($regP,$authtype,$lang);
				}
			}
		}
		return $result;
	}

	public function searchInAdmin()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=Array('type','user');
		$criteria->compare('t.ID',$this->ID,false);
		$criteria->compare('user.username',$this->username,true);
		$criteria->compare('t.LATITUDE',$this->LATITUDE);
		$criteria->compare('t.LONGITUDE',$this->LONGITUDE);
		$criteria->compare('t.ADDRESS',$this->ADDRESS,true);
		$criteria->compare('t.STATE',$this->STATE,true);
		if ($this->DATE_CREATED) {
			$DATE_CREATED=CDateTimeParser::parse($this->DATE_CREATED, 'dd.MM.yyyy');
			$criteria->addCondition('t.DATE_CREATED >='.$DATE_CREATED.' AND t.DATE_CREATED <='.($DATE_CREATED+86400));
			}		
		$criteria->compare('t.DATE_STATUS',$this->DATE_STATUS,true);
		$criteria->compare('t.COMMENT1',$this->COMMENT1,true);
		$criteria->compare('t.COMMENT2',$this->COMMENT2,true);
		$criteria->compare('t.TYPE_ID',$this->TYPE_ID,false);
		$criteria->compare('type.alias',$this->type_alias,true);
		$criteria->compare('t.ADR_CITY',$this->ADR_CITY,true);
		$criteria->compare('t.PREMODERATED',$this->PREMODERATED,true);
		$criteria->together=true;
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				        'pageSize'=> Yii::app()->user->getState('pageSize',20),			        
				    ),
			'sort'=>array(
			    'defaultOrder'=>'t.DATE_CREATED DESC',
				)
		));
	}	
}
