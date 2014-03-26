<?php 
if(Yii::app()->getLanguage()=="ru"){$param="auth_ru";}else{$param="auth_ua";}
foreach($hole->requests as $request){
	if($request->answers){
		foreach($request->answers as $answer){
				echo CHtml::openTag('div', array('class'=>'after'));
				echo '<h2>';
				echo Yii::t('holes_view', 'HOLE_AUTHREPLY_USER_DATE', array('{0}'=>$request->$param->name,'{1}'=>$request->user->fullname, '{2}'=>date('d.m.Y',$answer->date)));
				echo '</h2>';

			if ($answer->files_other){
				foreach($answer->files_other as $file){
					echo "<p class='holes_pict_p'>";
					if ($request->user_id==Yii::app()->user->id)
						echo CHtml::link(Yii::t('template', 'DELETE_FILE'), Array('delanswerfile','id'=>$file->id), Array('class'=>'declarationBtn'));
					echo "<br>".CHtml::link($file->file_name, $answer->filesFolder.'/'.$file->file_name, Array('class'=>'declarationBtn')); 
					echo "</p>";
				}
			}

			foreach($answer->files_img as $img){
				echo "<p class='holes_pict_p'>";
				if ($request->user_id==Yii::app()->user->id)
					echo CHtml::link(Yii::t('template', 'DELETE_IMAGE'), Array('delanswerfile','id'=>$img->id), Array('class'=>'declarationBtn')).'<br />';
				echo CHtml::link(CHtml::image($answer->filesFolder.'/thumbs/'.$img->file_name), 
					$answer->filesFolder.'/'.$img->file_name, 
					array('class'=>'holes_pict',
					'rel'=>'answer_'.$answer->id, 
					'title'=> Yii::t('template', 'UPLOAD_AT_DATE', array('{0}'=>Y::dateTimeFromTime($answer->createdate))), 
				));
				echo "</p>";
			}
//следует добавить ссылку для редактирования ответов
			echo CHtml::closeTag('div');
			if($answer->comment) echo Yii::t('template', 'COMMENT').$answer->comment."</p>";
		}

	}
}

?>
