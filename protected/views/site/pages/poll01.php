<?php
	$canvote=1;

	if(count($_POST)){
		$data = $_POST;
		if(Yii::app()->user->id){
			$poll_user=Yii::app()->user->id;
		}else{//autoreg
				$users = UserGroupsUser::model()->findAllByAttributes(array(),"email=:email",array(":email"=>trim($data['email'])));
				if(count($users)==0){
					$umodel=new UserGroupsUser('autoregistration');
					$umodel->username=trim($data['email']);
					$umodel->name=$data['first_name'];
					$umodel->email=trim($data['email']);

					    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
					    for ($i = 0; $i < 8; $i++) {
					        $n = rand(0, count($alphabet)-1);
				        	$pass[$i] = $alphabet[$n];
					    }

					$umodel->password=$pass;
					if($umodel->save()){
						$poll_user=$umodel->primaryKey;
					}
					}else{
						$poll_user=$users[0]->id;
					}
		}
		$vote= var_export($data, true);
//		file_put_contents(Yii::getPathOfAlias('webroot')."/upload/poll01.log",$a,FILE_APPEND);
		$poll = new Poll;
		$test = $poll->findAllByAttributes(array(),"u_id=:u_id",array(":u_id"=>$poll_user));
		if(count($test)){
			$canvote=0;
		}else{
			$poll->poll = "poll01";
			$poll->u_id=$poll_user;
			$poll->vote=$vote;
			$poll->save();
			$canvote=2;
		}
	}

	if($canvote==1){
		$this->widget('application.widgets.poll.Poll01');
	}elseif($canvote==2){
		if(Yii::app()->getLanguage()=="ru"){
			echo "<h3><i>Спасибо, Ваш голос учтен!</i></h3>";
		}else{
			echo "<h3><i>Дякуемо, Ваш голос зараховано!</i></h3>";
		}
		echo CHtml::link(CHtml::tag('span', array(), Yii::t('template', 'ADD_DEFECT')), array('/holes/add'));
	}else{
		if(Yii::app()->getLanguage()=="ru"){
			echo "<h3><i>Извините, но Вы не можете голосовать дважды!</i></h3>";
		}else{
			echo "<h3><i>Вибачте, але Вы не можете голосувати двiчi!</i></h3>";
		}
		echo CHtml::link(CHtml::tag('span', array(), Yii::t('template', 'ADD_DEFECT')), array('/holes/add'),array('class'=>'button'));
	}
?>
