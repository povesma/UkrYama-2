<div class="collection">
	<span class="label"><?php echo Yii::t('template', 'COUNT_IN_COLLECTION')?></span>
	<div class="collection-counter-wrap">
		<div class="collection-item">
			<div class="wrap">
				<span class="inside">
					<?php 
						for($i = 0, $count = strlen($all) ; $i < $count; $i++) {
                     echo CHtml::tag('span', array(), substr($all, $i, 1));						   
						}
					?>
				</span>
			</div>
            <?php echo preg_replace('/[0-9 ]/ui', '', Y::declOfNum($all, Yii::t('template', 'COUNT_DEFECTS')))?>
		</div>
		<div class="collection-item">
			<div class="wrap">
				<span class="inside">
					<?php 
						for($i = 0, $count = strlen($ingibdd) ; $i < $count; $i++) {
						    echo CHtml::tag('span', array(), substr($ingibdd, $i, 1));
						}
					?>
				</span>
			</div>
         <?php echo Yii::t('template', 'COUNT_GAI'); ?>			
		</div>
		<div class="collection-item">
			<div class="wrap">
				<span class="inside">
					<?php 
						for($i = 0, $count = strlen($fixed) ; $i < $count; $i++) {
						    echo CHtml::tag('span', array(), substr($fixed, $i, 1));
						}
					?>
				</span>
			</div>
         <?php echo Yii::t('template', 'COUNT_COMMIT'); ?>				
		</div>
		<div class="collection-item how">
         <?php echo CHtml::link(Yii::t('template', 'HOW_TO_SET_BETTER'), array('/page/donate')); ?>
		</div>
	</div>
</div>