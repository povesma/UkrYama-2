<?php 

echo CHtml::openTag('li', (($index+1)%4==0) ? array('class'=>'noMargin') : array());
   echo CHtml::link(CHtml::image($data->STATE == Holes::STATE_FIXED && $data->pictures_fixed ? $data->pictures_fixed[0]->small : ($data->pictures_fresh ? $data->pictures_fresh[0]->small:'')), array('view', 'id'=>$data->ID), array('class'=>'photo')); 

   if (isset($showcheckbox) && $showcheckbox){
      echo CHtml::checkBox('hole_id[]', $data->isSelected ? true : false, array('value'=>$data->ID, 'class'=>'hole_check')); 
   }
   if($user->isModer){
      if(!$data->PREMODERATED){?>
         <div class="premoderate" id="premoderate_<?= $data->ID ?>"><img src="/images/tick22.png" onclick="setPM_OK('<?= $data->ID ?>');" title="<?= Yii::t('template', 'PREMODERATE_DEFECT')?>"/></div>
		<?php } ?>
		<div class="del"><a title="<?= Yii::t('template', 'DELETE_DEFECT')?>" href="#" onclick="ShowDelForm(this, '<?= $data->ID ?>'); return false;"><img src="/images/cross22.png"/></a></div>
<?php
}elseif($data->USER_ID==$user->ID && $data->STATE==Holes::STATE_FRESH){
?>
		<div class="del"><a title="<?= Yii::t('template', 'DELETE_DEFECT')?>" href="#" onclick="ShowDelForm(this, '<?= $data->ID ?>'); return false;"><img src="/images/cross22.png"/></a></div>
<?php } ?>  
   <div class="properties">
   	<p class="date">
         <?php 
         echo CHtml::encode(Y::dateFromTime($data->DATE_CREATED)); 
         if ($data->comments_cnt) 
            echo CHtml::link(CHtml::tag('span', array('class'=>'commentsHot'), $data->comments_cnt), 
               array('view', 'id'=>$data->ID, '#'=>'comments'), 
               array('title'=>Yii::t('template', 'COMMENTS'))
            ); 
         else 
            echo CHtml::link(CHtml::tag('span', array('class'=>'commentsHot_0'), 0), 
               array('view', 'id'=>$data->ID, '#'=>'comments'), 
               array('title'=>Yii::t('template', 'NOCOMMENTS'))
            );
         ?>
      </p>
   	<div class="service"><?= CHtml::encode($data->ADDRESS); ?><i></i></div>
   	<div class="social">   		
         <img src="/images/st1234/<?= CHtml::encode($data->type->alias); ?>.png" title="<?= CHtml::encode($data->type->name); ?>"/>   		
         <span class="status_span state_<?= $data->STATE ?>">&bull;</span>
   		<span class="status_text"><?= CHtml::encode($data->StateName); ?></span>
         
   		<?php  if($data->WAIT_DAYS): ?>
   			<span class="status_days"><i>
               <?= Yii::t('template', 'INFO_COUNT_DAYS_WAIT_SHORT', array('{0}'=>Y::declOfDays($data->WAIT_DAYS))) ?>
            </i></span>
   		<?php endif; ?>
   		<?php  if($data->PAST_DAYS): ?>
   			<span class="status_days"><i>
               <?= Yii::t('template', 'INFO_COUNT_PAST_DAYS_SHORT', array('{0}'=>Y::declOfDays($data->PAST_DAYS))) ?>
            </i></span>
   		<?php endif; ?>
   	</div>
   </div>
</li>	
