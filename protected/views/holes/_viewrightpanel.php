<div class="progress">
   <?php if($hole->WAIT_DAYS): ?>
   <div class="lc">
      <div class="wait">
         <span class="days"><?php echo $hole->WAIT_DAYS ?></span>
         <span class="day-note"><?php echo Yii::t('template', 'INFO_COUNT_DAYS_WAIT', array('{0}'=>Y::declOfDays($hole->WAIT_DAYS, false))) ?></span>
     </div>
   </div>
   <?php elseif($hole->PAST_DAYS): ?>
   <div class="lc">
      <div class="wait">
         <span class="days"><?php echo $hole->PAST_DAYS ?></span>
         <span class="day-note"><?php echo Yii::t('template', 'INFO_COUNT_PAST_DAYS', array('{0}'=>Y::declOfDays($hole->PAST_DAYS, false))) ?></span>
      </div>
   </div>
   <?php endif; ?>
<script>
$(window).keydown(function(e){
	if (e.keyCode==80 && e.ctrlKey){
		var c=document.getElementById('pdf_form');
		if(c){
			c.style.display='block';
			e.preventDefault();
		}
	}
	if (e.keyCode==27){
		var c=document.getElementById('pdf_form');
		if(c){
			c.style.display='none';
			e.preventDefault();
		}
	}


});
</script>
	<div class="lc">
		<a href="/payments/add?holeid=<?php echo $hole->ID?>" class="button"><?= Yii::t('holes_view', 'SEND_GAI_ONLINE')?><sub>*</sub></a>
	</div><br />

<?php if(!Yii::app()->user->isGuest){ ?>

<?php
	$requests=$hole->requests_user;
	$status=0;
	$req=false;
	if(count($requests)>0){
		$req=$requests[count($requests)-1];
		if($req->answer){
			$answ=$req->answer;
			$status=2;
		}else{
			$status=1;
		}
	}

	if($status!=1){
	?>
         		<div class="lc">
       			<a href="#" onclick="var c=document.getElementById('pdf_form');if(c){c.style.display=c.style.display=='block'?'none':'block';c.focus()}return false;" class="button"><?= Yii::t('holes_view', 'PRINT_CLAIM') ?></a>
         		</div><br />
		<div class="pdf_form" id="pdf_form"<?= isset($_GET['show_pdf_form']) ? ' style="display: block;"' : '' ?>>
			<a href="#" onclick="var c=document.getElementById('pdf_form');if(c){c.style.display=c.style.display=='block'?'none':'block';}return false;" class="close">&times;</a>
			<div id="gibdd_form"></div>
        <?php
		if($status==0){
			$this->renderPartial('_form_request', array('hole'=>$hole, "first"=>1));
		}elseif($status==2){
			$this->renderPartial('_form_request', array('hole'=>$hole, "first"=>2,'req'=>$req, 'answ'=>$answ));
		}
	?>
		</div>

	<?php
		$this->widget('application.widgets.holesent.HoleSent', array('hole'=>$hole,'req'=>$req));
		echo CHtml::tag('p', array(), CHtml::link(Yii::t('holes_view', 'CLAIM_WAS_SEND'), "javascript:void(0)", array('class'=>"declarationBtn",'onClick'=>"holesent.style['display']='inline';this.style['display']='none';")));
		if($status==2): ?>
					<div class="cc">
						<p><?php echo Yii::t('holes_view', 'INFO_IF_DEFECT_FIXED') ?></p>
						<p><?php echo CHtml::link(Yii::t('holes_view', 'SET_AS_FIXED'), array('fix', 'id'=>$hole->ID),array('class'=>"declarationBtn")); ?></p>
					</div>
	<?php endif;

	}else{
	?>
		<div class="rc">
			<p><?= CHtml::link(Yii::t('holes_view', 'CANCEL_REQUEST_MY_CLAIM'), array('notsent', 'id'=>$hole->ID),array('class'=>"declarationBtn")); ?></p>
		</div>
	<?php } ?>
	<?php if($status!=0): ?>
		<div class="rc">
			<p><?php echo CHtml::link(Yii::t('holes_view', 'HOLE_REPLY_RECEIVED'), array('reply', 'id'=>$hole->ID),array('class'=>"declarationBtn")); ?></p>
		</div>
	<?php endif; ?>
<?php } ?>
</div>
