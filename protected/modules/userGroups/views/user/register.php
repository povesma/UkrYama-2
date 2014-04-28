<?php
$this->breadcrumbs=array(
	Yii::t('UserGroupsModule.general','User Registration'),
);
?>
<noindex>
<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'user-groups-passrequest-form',
			'enableAjaxValidation'=>false,
			'enableClientValidation'=>true,
		)); ?>

<table class="data-table bx-registration-table">
	<thead>
		<tr>
			<td colspan="2"><b><?php echo Yii::t('UserGroupsModule.general','REGISTER_NEW')?></b></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $form->labelEx($model,'name'); ?></td>
			<td>
                <?php echo $form->textField($model,'name'); ?>
			    <?php echo $form->error($model,'name'); ?>
            </td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'last_name'); ?></td>
			<td>
                <?php echo $form->textField($model,'last_name'); ?>
			    <?php echo $form->error($model,'last_name'); ?>
            </td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'username'); ?></td>
			<td>
                <?php echo $form->textField($model,'username'); ?>
			    <?php echo $form->error($model,'username'); ?>
            </td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'password'); ?></td>
			<td>
                <?php echo $form->passwordField($model,'password'); ?>
			    <?php echo $form->error($model,'password'); ?><br />
                <?php echo Yii::t('UserGroupsModule.general','PASS_6')?>
                
            </td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'password_confirm'); ?></td>
			<td>
                <?php echo $form->passwordField($model,'password_confirm'); ?>
			    <?php echo $form->error($model,'password_confirm'); ?>
            </td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'email'); ?></td>
			<td>
                <?php echo $form->textField($model,'email'); ?>
			    <?php echo $form->error($model,'email'); ?><br />
                <?php echo Yii::t('UserGroupsModule.general','EMAIL_CONF')?>

            </td>
		</tr>
		<tr>
			<td colspan="2"><b>   <?php echo Yii::t('UserGroupsModule.general','REG_CAPCHA')?></b></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php $this->widget('CCaptcha', array(
				'clickableImage'=>true,
				'buttonOptions'=>array(
					'id'=>'refreshCaptcha',
				),
			)); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'captcha'); ?></td>
			<td>
                <?php echo $form->textField($model,'captcha'); ?>
			    <?php echo $form->error($model,'captcha'); ?>
            </td>
		</tr>
			</tbody>
	<tfoot>
		<tr>
			<td></td>
			<td>
                <?php echo CHtml::submitButton(Yii::t('UserGroupsModule.general','REGISTER_NEW')); ?>
            </td>
		</tr>
	</tfoot>
</table>
<p><span class="required">*</span> <?php echo Yii::t('UserGroupsModule.general','REQUIRED_FILDS')?></p>

<p>
<a href="/userGroups/" rel="nofollow"><b><?php echo Yii::t('UserGroupsModule.general','AUTH')?></b></a>
</p>

<?php $this->endWidget(); ?>
</noindex>
	</div>