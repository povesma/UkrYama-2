<?php
class EventController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/header_user';
//	public $layout='//layouts/none';

	
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
				'actions'=>array('AdminEvent', 'AdminGT'),
				'groups'=>array('root', 'admin'), 
			),
			
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('ListEvents','ViewEvent', 'AddEvent', 'GetAddress'),
				'users'=>array('*'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}	
	
	public function actionListEvents(){

		$events = Event::model()->with("media")->findAll();
		$this->render("events", array("events"=>$events));
	}
	public function actionViewEvent($id){
		$this->layout='//layouts/header_default_without_add';
		$event = new Event;
		$event = $event->with("type","user","media")->findByPk($id);
		$tree = EventTree::model()->findAll();
		$this->render("event", array("event"=>$event, 'tree'=>$tree));
	}
	public function actionGetAddress(){
		header('Access-Control-Allow-Origin: *');
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		$uri = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&language=uk&sensor=false";
		$r = new Http;
		echo $r->http_request($uri);
	}
	public function actionAddEvent(){
		$data=$_POST;
		$model = new Event;
		$model->u_id=$data['uid'];
		$model->lat=$data['lat'];
		$model->lng=$data['lng'];
		$model->address=$data['address'];
		$model->message=$data['message'];
		$model->status=0;
		if($model->save()){
			$e_id=$model->primaryKey;
			$model = new EventMedia;
			foreach(explode(",",$data['files'],-1) as $id){
				$model->updateByPk($id, array("e_id"=>$e_id));
			}
			$tids=explode(",",$data['tid']);
			foreach($tids as $tid){
				$model = new EventType;
				$model->event=$e_id;
				$model->node=$tid;
				$model->save();
			}
			echo 1;
		}else{echo 0;}
	}

	public function actionAdminEvent(){
		$data=$_POST;
	}

	private function approveEvent($id){}
	private function delEvent($id){}
	private function printEvent($id){}

	//Admin Groups and Types
	public function actionAdminGT(){
		if(count($_POST)){
			$data=$_POST;
			switch($data['do']){
				case "addNode":
					$model = new EventTree;
					$model->name=$data['name'];
					$model->description=$data['desc'];
					$model->lang=$data['lang'];
//					$model->numb=$data['numb'];
					$model->refer=$data['ref'];
					if($model->save()){
						echo $model->primaryKey;
					}
					break;
				case "editNode":
					$model = new EventTree;
					$model->updateByPk($data['id'], array("name"=>$data['name'],"description"=>$data['desc']));
					$model->save();
					echo "ok";
					break;
				case "delNode":
					$model = new EventTree;
					$model->deleteByPk($data['id']);
					$model->deleteAllByAttributes(array(),"refer=:ref",array(':ref'=>$data['id']));
					break;
				case "changeLang":
					$this->listNodes($data['lang']);
					break;
			}
		}else{
			$this->listNodes("ua");
		}
	}
	private function listNodes($lang){
		$gr = new EventTree;
		$tree = $gr->findAll("lang=:lang",array(":lang"=>$lang));
		$this->render("gt", array("tree"=>$tree,"lang"=>$lang));
	}
}
?>
