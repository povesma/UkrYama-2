<?php


$this->widget('application.extensions.fancybox.EFancyBox', array(
		'target'=>'.holes_pict',
		'config'=>array('attr'=>'hole',),
	)
);
?>
<style>
#map-canvas {
	height: 600px;
	width: 730px;
}
#bigmap{
	position:absolute;
	z-index:900;
}
</style>

<div class="head">
	<div class="container">
		<div class="lCol">
			<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/images/logo.png", $this->pageTitle), "/", array('class'=>'logo', 'title'=>Yii::t('template','GOTO_MAIN'))); ?>
		</div> 
		<div class="rCol">
			<div class="r">
				<div class="add-by-user">
					<span><?php echo Yii::t('template', 'DEFECT_ADDEDBY')?></span>
					<?php $fullName = null; 
                                         if ($hole->user != null ) { // иногда бывает так, что пользователя у ямы нет почему-то: пользователь удалился, а его ямы остались.
						$fullName = $hole->user->getParam('showFullname') ? $hole->user->Fullname : $hole->user->username;
					 } else {
 						$fullName = "The hole has no owner ...";
					 }
                                         echo CHtml::link(CHtml::encode($fullName), array('/profile/view', 'id'=>$hole->user->id),array('class'=>""));?>
				</div>
				<div class="control">
					<!-- RIGHT PANEL -->
					<?php $this->renderPartial('_viewrightpanel', array('hole'=>$hole)) ?>
				</div>
			</div>
			<div class="h">
				<?php if($hole['LATITUDE'] && $hole['LONGITUDE']):?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
function initialize() {
  mapdiv=document.getElementById('bigmap');
  mapdiv.style['display']='';
  var mapOptions = {
    zoom: 14,
    center: new google.maps.LatLng(<?= $hole->LATITUDE ?>, <?= $hole->LONGITUDE ?>),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  marker = new google.maps.Marker({
    map:map,
    draggable:false,
    position: new google.maps.LatLng(<?= $hole->LATITUDE ?>, <?= $hole->LONGITUDE ?>),
    icon: "/images/st1234/<?= $hole->type->alias;?>_<?= $hole['STATE'] ?>.png"
  });
}

</script>
<div id="bigmap" style="display:none;">
	<table>
	<tr><td style="background-color:white;"><div onClick="bigmap.style['display']='none';" style="float:right;"><u><b style="cursor:pointer;">X</b></u></div></td></tr>
	<tr><td><div id="map-canvas"></td></tr>
	</table>
</div>
<div  id="ymapcontainer">
	<img onClick="initialize()" src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $hole->LATITUDE ?>,<?= $hole->LONGITUDE ?>&zoom=14&size=280x300&markers=color:red%7Clabel:Дефект%7Cicon:http://ukryama.com/images/st1234/<?= $hole->type->alias;?>_<?= $hole['STATE'] ?>.png|<?= $hole->LATITUDE ?>,<?= $hole->LONGITUDE ?>&sensor=false"><br>
</div>
				<?php endif;?>
				<div class="info">
					<div>
						<span class="date"><?php echo CHtml::encode(Y::dateFromTime($hole->DATE_CREATED)); ?></span>
						<?php
						$userGroup = UserGroupsUser::model()->findByPk(Yii::app()->user->id);
						if (isset($userGroup->level) && $userGroup->level > 1):?>
						<div class="edit-container">
						  <?php 
							if(Yii::app()->user->isModer && !$hole->PREMODERATED){
								echo CHtml::link("Подтвердить",array('moderate','id'=>$hole->ID))." ";
							}

							if ($hole->STATE == Holes::STATE_FRESH)
								echo CHtml::link(Yii::t('holes_view', 'EDIT'), array('update', 'id'=>$hole->ID));
								echo CHtml::link(Yii::t('holes_view', 'DELETE'), 
										array('personalDelete', 'id'=>$hole->ID), 
										array('onclick'=>'return confirm("'.Yii::t('holes_view', 'DELETE_DEFECT_CONFIRM').'");', 'class'=>'delete')); 
						  ?>
						</div>
						<?php endif;?>
					</div>
					<p class="type type_<?= $hole->type->alias ?>"><?php echo $hole->type->getName(); ?></p>
					<p class="address"><?= CHtml::encode($hole->ADDRESS) ?></p>
					<p class="status">
                                            
	   					<span class="bull <?= $hole->STATE ?>">&bull;</span><b><?=CHtml::encode($hole->StateName)?></b><br />
                                               <?php if($pays and $userGroup->level)
                                                {?>
                                                <span class="money"></span><b>Оплачено.</b> Сума: <?php echo $pays->amount; if($currency == 'UAH') { echo 'грн.'; } else { echo '$'; }?> Дата: <?php echo $pays->date; } ?> 
                                                
						<?php
							$arr[] = array('name'=>CHtml::tag('b', array(), Yii::t('holes_view', 'HOLE_CREATED_INFO')));
							$arr[] = array('date'=>Y::dateTimeFromTime($hole->createdate), 'name'=>Yii::t('holes_view', 'HOLE_CREATED'));
							$arr[] = array('date'=>Y::dateFromTime($hole->DATE_CREATED), 'name'=>Yii::t('holes_view', 'HOLE_FIND'));

							$requests = $hole->requests;
							if(Yii::app()->getLanguage()=="ru"){$param="auth_ru";}else{$param="auth_ua";}

							foreach($requests as $request){
								$arr[] = array('name'=>CHtml::tag('b', array(), Yii::t('holes_view', 'HOLE_REQUEST_USER_TO', array('{0}'=>$request->user->getFullname(),'{1}'=>$request->$param->name))), 'date'=>Y::dateFromTime($request->date_sent));
								$deliv=$request->req_sent;
								if(count($deliv)){
									if(!$deliv->status) { // якщо статус був "не доставлено", перевіряємо, як воно зараз
									  $deliv->updateMail();
									  if ($deliv->status == 1) { // якщо нарешті доставлено - інформуємо користувача.  Цей цикл треба в крон поставити 4 рази на добу, наприклад
									  }
									} 

									if($deliv->status){
										if($deliv->status!=2){$arr[] = array('name'=>Yii::t('holes_view', 'HOLE_REQUEST_DELIVERED',array('{0}'=>$request->$param->name)), 'date'=>Y::dateFromTime($deliv->ddate));}
									}else{
										if(strlen($deliv->status)){$arr[] = array('name'=>Yii::t('holes_view', 'HOLE_REQUEST_DELIVERDATE',array('{0}'=>$request->$param->name)), 'date'=>Yii::t('holes_view', 'HOLE_REQUEST_NOTDELIVERED'));}
									}
								}
								if($request->answers) foreach($request->answers as $answer){
									$arr[] = array('name'=>Yii::t('holes_view', 'HOLE_ANSWER_DATE_FROM',array('{0}'=>$request->$param->name)), 'date'=>Y::dateFromTime($answer->date));
									$arr[] = array('name'=>Yii::t('holes_view', 'HOLE_ANSWER_CREATEDATE_FROM',array('{0}'=>$request->$param->name)), 'date'=>Y::dateTimeFromTime($answer->createdate));
								}
							}

							$fixeds = $hole->fixeds;
							if ($fixeds) foreach ($fixeds as $fix){
								$arr[] = array('name'=>CHtml::tag('b', array(), Yii::t('holes_view', 'HOLE_FIX_USER', array('{0}'=>$fix->user->FullName))));
								$arr[] = array('name'=>Yii::t('holes_view', 'HOLE_FIX_DATE'), 'date'=>Y::dateFromTime($fix->date_fix));
								$arr[] = array('name'=>Yii::t('holes_view', 'HOLE_FIX_CREATEDATE'), 'date'=>Y::dateTimeFromTime($fix->createdate));
							}

							$dataProvider = new CArrayDataProvider($arr, array('pagination'=>false,'keyField'=>false));
							$this->widget('zii.widgets.grid.CGridView', array(
								'dataProvider' => $dataProvider,
								'summaryText' => '', // 1st way
								'hideHeader'=>true,
								'template' => '{items}{pager}', // 2nd way
								'columns' => array(array('name'=>'name', 'type'=>'raw'), 'date'),
							));

						?>
						</span>
					</p>
					<?php if(!$hole->PREMODERATED) { ?>
					<p><font class="errortext premoderate"><?php echo  Yii::t('holes_view', 'PREMODRATION_WARNING');?></font><br/></p>
					<?php } ?>
					<div class="social">
						<div class="like">
							<!-- Facebook like -->
							<div id="fb_like">
								<noindex><iframe src="http://www.facebook.com/plugins/like.php?href=<?=Yii::app()->request->hostInfo?>/<?=Yii::app()->request->pathInfo?>&amp;layout=button_count&amp;show_faces=false&amp;width=180&amp;action=recommend&amp;font&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:180px; height:21px;" allowTransparency="true"></iframe></noindex>
							</div>

							<!-- Vkontakte like -->
							<noindex>
								<div id="vk_like"></div>
								<script type="text/javascript">VK.Widgets.Like("vk_like", {type: "button", verb: 1});</script>
							</noindex>
					</div>
					<div class="share">
						<span><?php echo Yii::t('template', 'SHARE')?></span>
						<div class="likenew">
						<noindex>
							<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
							<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="vkontakte,facebook,twitter,lj"></div>
						</noindex>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="mainCols" id="col">
	<div class="lCol">
		<div class="comment">
			<?php echo $hole['COMMENT1'] ?>
		</div>
   </div>
   <div class="rCol">
      <div class="b">
         <div class="before">
			<?php 
            if($hole->pictures_fresh){  // было
               echo CHtml::tag('h2', array(), Yii::t('holes_view', 'HOLE_ITWAS'));
   			   foreach($hole->pictures_fresh as $i=>$picture){
				echo "<p class='holes_pict_p'>";
				echo CHtml::link(CHtml::image($picture->small), 
					$picture->medium, 
					array('class'=>'holes_pict',
						'rel'=>'hole',
						'title'=>CHtml::encode($hole->ADDRESS))
					);
				echo "</p>";
               } 
            }
         ?>
         </div>
         
         <!-- ANSWERS PANEL -->
         <?php $this->renderPartial('_viewanswers', array('hole'=>$hole)) ?>
      
   		<?php //стало
	if($hole['STATE'] == Holes::STATE_FIXED){
		if($hole->pictures_fixed){ 
			echo CHtml::tag('h2', array(), Yii::t('holes_view', 'HOLE_ITBECAME'));
			foreach($hole->pictures_fixed as $i=>$picture){
				echo "<p class='holes_pict_p'>";
				if ($picture->user_id==Yii::app()->user->id || Yii::app()->user->level > 80 || $hole->IsUserHole)
					echo CHtml::link(Yii::t('template', 'DELETE_IMAGE'), Array('delpicture','id'=>$picture->id), Array('class'=>'declarationBtn')).'<br />';
				echo CHtml::link(CHtml::image($picture->medium), 
					$picture->original, 
					array('class'=>'holes_pict',
						'rel'=>'hole_fixed',
						'title'=>CHtml::encode($hole->ADDRESS).' - исправлено')
					);
				echo "</p>";
			}
		}
   		if($hole['COMMENT2']){
			echo CHtml::tag('div', array('class'=>'comment'), $hole['COMMENT2']);
		}
	}?>
      
   	</div>
   </div>
   <div class="rCol">
      <div class="b">
      <?php
          $this->widget('comments.widgets.ECommentsListWidget', array(
              'model' => $hole,
          ));
      ?>
      </div>
   </div>
</div>
