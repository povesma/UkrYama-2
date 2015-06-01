<div id="userGroups-container">
	<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
	<?php endif; ?>
	<?php if(isset(Yii::app()->request->cookies['success'])): ?>
	<div class="info">
		<?php echo Yii::app()->request->cookies['success']->value; ?>
		<?php unset(Yii::app()->request->cookies['success']);?>
	</div>
	<?php endif; ?>
	<?php if(Yii::app()->user->hasFlash('mail')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('mail'); ?>
    </div>
	<?php endif; ?>
	<div class="form center">
	
	</div><!-- form -->
</div>
<div class="bx-auth">
	<div class="bx-auth-title"><?php echo Yii::t('UserGroupsModule.general','ENTER_SITE_TITLE')?></div>
	<div class="bx-auth-note"><?php echo Yii::t('UserGroupsModule.general','AUTH_PLEASE')?></div>

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableAjaxValidation'=>false,
		'focus'=>array($model, 'username'),
	)); ?>
	
	<table class="bx-auth-table">
			<tr>
				<td class="bx-auth-label"><?php echo $form->labelEx($model,'username'); ?>:</td>
				<td><?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'username'); ?>
				</td>
			</tr>
			<tr>
				<td class="bx-auth-label"><?php echo $form->labelEx($model,'password'); ?>:</td>
				<td><?php echo $form->passwordField($model,'password'); ?>
					<?php echo $form->error($model,'password'); ?>
				</td>
			</tr>
						<tr>
				<td></td>
				<td><?php echo $form->checkBox($model,'rememberMe'); ?>
					<?php echo $form->label($model,'rememberMe'); ?>
					<?php echo $form->error($model,'rememberMe'); ?>
			</td>
			</tr>
			<tr>
				<td></td>
				<td class="authorize-submit-cell"><?php echo CHtml::submitButton(Yii::t('UserGroupsModule.general','ENTER_SITE')); ?>
					<noindex>
				<a href="/userGroups/user/passRequest/" rel="nofollow"><?php echo Yii::t('UserGroupsModule.general','LOST_PASSWORD')?></a>
				<?php 
					$http=new Http;
					$url="https://chat.ingenia.name/auth/code";
					$a= $http->http_request(array('url'=>$url,'return'=>'content', 'data'=>array('session'=>Yii::app()->request->cookies['PHPSESSID'])));
					$json = json_decode($a, true);
					echo $json["code"];
				?>
		</noindex>
				</td>
			</tr>
		</table>
		
		
		
		<?php if (UserGroupsConfiguration::findRule('registration')): ?>
		<noindex>
			<p class="bottom-text">
				<big><?php echo CHtml::link(Yii::t('UserGroupsModule.general','REGISTER'), array('/userGroups/user/register'))?></big><br />
				<?php echo Yii::t('UserGroupsModule.general','FILL_REG_FORM')?> 
			</p>
		</noindex>
		<?php endif; ?>		
				
	
	<?php $this->endWidget(); ?>	
	
</div>

<script type="text/javascript">
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
</script>

<div class="bx-auth-title"><?php echo Yii::t('UserGroupsModule.general','ENTER_AS_USER')?></div>
<div class="bx-auth-note"><?php echo Yii::t('UserGroupsModule.general','ENTER_SOCIAL')?></div>
<?php $this->widget('ext.eauth.EAuthWidget', array('action' => '/userGroups/')); ?>

