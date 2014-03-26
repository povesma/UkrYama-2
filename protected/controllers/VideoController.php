<?php

class VideoController extends Controller
{
//	protected $MAX_UPLOAD_SIZE=157286400;
	protected $MAX_UPLOAD_SIZE=52428800;
	protected $IMAGE=0;
	protected $LOCALVID=1;
	protected $YOUTUBE=2;

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
				'actions'=>array('index', 'play', 'upload', 'getThumb','addExternal', 'deleteFile'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('add'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete', 'moderate'),
				'groups'=>array('root', 'admin', 'moder'), 
			),
			array('allow', // allow admin user to perform 'admin' actions
				'actions'=>array('admin', 'itemsSelected'),
				'groups'=>array('root',), 
			),
			array('deny',  // deny all users
				'users'=>array('*'),  
			),
		);
	}

	public function actionIndex(){
		$this->layout='//layouts/header_default';
		$this->render('up');
	}
	public function actionPlay($id){
		$this->layout='//layouts/header_default';
		$video=Video::model()->findByPk($id);
		if(count($video)){
			$this->render('play', array('url' => $video->path));
		}else{
			echo "Video not found!";
		}
	}
	public function actionDeleteFile(){
		$id=$_POST['id'];
		$model = new EventMedia;
		$model->deleteByPk($id, "e_id=0");
	}
	public function actionUpload(){
                $tempFolder=Yii::getPathOfAlias('webroot').Yii::app()->params['upload_path'];
 
                mkdir($tempFolder, 0777, TRUE);
                mkdir($tempFolder.'chunks', 0777, TRUE);
 
                Yii::import("ext.EFineUploader.qqFileUploader");
 
                $uploader = new qqFileUploader();
                $uploader->allowedExtensions = Yii::app()->params['upload_ext'];
                $uploader->sizeLimit = $this->MAX_UPLOAD_SIZE;//maximum file size in bytes
                $uploader->chunksFolder = $tempFolder.'chunks';

                $result = $uploader->handleUpload($tempFolder);
                $result['filename'] = $uploader->getUploadName();
		$savedfile=$result['filename'];
                $result['folder'] = $webFolder;
 
                $uploadedFile=$tempFolder.$result['filename'];
 
		$uploaded=1;
                header("Content-Type: text/plain");
//echo Yii::getPathOfAlias('webroot').Yii::app()->params['upload_path'];
		if($uploaded){
			$video = new EventMedia;
			$video->e_id=0;
			$video->path=Yii::app()->params['upload_path'].$savedfile;
			if(strstr(mime_content_type(Yii::getPathOfAlias('webroot').$video->path),"video")){
				$video->type=$this->LOCALVID;
				$video->name="Local Video";
			}elseif(strstr(mime_content_type(Yii::getPathOfAlias('webroot').$video->path),"image")){
				$video->type=$this->IMAGE;
				$video->name="Local Image";

				//resize image
				$image=Yii::app()->image->load(Yii::getPathOfAlias('webroot').$video->path);
				$image->quality(6);
				$fname=$video->path;
				if($image->__get("width")>3200){
					$pfile=dirname($fname)."/big.".basename($fname);
					$image->resize(3200);
					$image->save(Yii::getPathOfAlias('webroot').$pfile);
				}else{
					$pfile=dirname($fname)."/big.".basename($fname);
					$image->save(Yii::getPathOfAlias('webroot').$pfile);
				}

				$pfile=dirname($fname)."/medium.".basename($fname);
				$image->resize(800);
				$image->save(Yii::getPathOfAlias('webroot').$pfile);

				$pfile=dirname($fname)."/small.".basename($fname);
				$image->resize(400);
				$image->save(Yii::getPathOfAlias('webroot').$pfile);

			}

			if($video->save()){
				$result['id']=$video->primaryKey;
		                $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
				echo $result;
			}
		}
                Yii::app()->end();
	}
	public function actionGetThumb(){
		echo "post_max_size: ".ini_get('post_max_size')."<br>";
		echo "upload_max_filesize: ".ini_get('upload_max_filesize')."<br>";
//		echo "thumbnail";
	}
	public function actionAddExternal(){
		$id=$_GET['id'];
		Yii::import('application.vendors.google-api-php-client.*');
		Yii::import('application.vendors.google-api-php-client.contrib.*');
		$client = new Google_Client();
		$youtube = new Google_YouTubeService($client);
		$thumb="";
		$title="";

		try {
			$searchResponse = $youtube->videos->listVideos("snippet",array('id'=>$id));
				//Цикл для изучения возвращаемого содержимого
				//foreach(array_keys($searchResponse['items'][0]['snippet']) as $key) echo $key."<br>";
				$thumb=$searchResponse['items'][0]['snippet']['thumbnails']['medium']['url'];
				$title=$searchResponse['items'][0]['snippet']['title'];
			
		} catch (Google_ServiceException $e) {
			$htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
			htmlspecialchars($e->getMessage()));
			echo $htmlBody;
		} catch (Google_Exception $e) {
			$htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
			htmlspecialchars($e->getMessage()));
			echo $htmlBody;
		}
		$uploaded=0;
		if(strlen($thumb)>1){$uploaded=1;}
		if($uploaded){
			$video = new Video;
			$video->type=$this->YOUTUBE;
			$video->name=$title;
			$video->thumb=$thumb;
			$video->path=$id;
			$video->save();
			echo "Using external URL";
		}


	}


}
?>
