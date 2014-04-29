<?php $this->beginContent('//layouts/main'); ?>

<div class="head">
	<div class="container">
      <div class="lCol">
         <?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/images/logo.png", $this->pageTitle), "/", array('class'=>'logo', 'title'=>Yii::t('template','GOTO_MAIN'))); ?>
      </div>
      <div class="rCol">
         <div id="head_user_info"> 
            <div class="counter">
               <span class="counter-text"><?php Yii::t('holes', 'all_defects'); ?></span><span class="count-class"><?php echo Y::declOfNum($this->user->usermodel->holes_cnt, array('', '', '')); ?></span>
               <span class="counter-text"><?php Yii::t('holes', 'fix_defects'); ?></span><span class="count-class"><?php echo Y::declOfNum($this->user->usermodel->holes_fixed_cnt, array('', '', '')); ?></span>
            </div>
								
         	<div class="photo">
         		<?php if($this->user->userModel->relProfile && $this->user->userModel->relProfile->avatar) echo CHtml::image($this->user->userModel->relProfile->avatar_folder.'/'.$this->user->userModel->relProfile->avatar, 'Аватар', array('width'=>'63','height'=>'63')); ?>
         	</div>
            
            <div class="info">		 
               <h1><?php echo $this->user->fullName; ?></h1>
               <!--<div class="www">
                  <a target="_blank" href="http://"></a>
               </div>-->
            </div>
            
            <div class="buttons usermenu-container">
      			<?php $this->widget('zii.widgets.CMenu', array(
      				'items'=>Array(
                     array('label'=>Yii::t('template', 'ADD_DEFECT'), 'url'=>array('/holes/add'), 'linkOptions'=>array('class'=>'profileBtn')),
                     array('label'=>Yii::t('template', 'MY_DEFECTS'), 'url'=>array('/holes/personal'), 'linkOptions'=>array('class'=>'profileBtn')),
                     array('label'=>Yii::t('template', 'MY_PLACE'), 'url'=>array('/holes/myarea'), 'linkOptions'=>array('class'=>'profileBtn')),
                     array('label'=>Yii::t('template', 'MY_PORTFOLIO'), 'url'=>array('/profile/update'), 'linkOptions'=>array('class'=>'profileBtn')),
     					),
      				'htmlOptions'=>array('class'=>'usermenu'),
      			));?>
               <div class="submenu-element">
               <?php if ($this->menu):?>
                  <?php $this->beginWidget('zii.widgets.CPortlet');
                  $this->widget('zii.widgets.CMenu', array(
                     'items'=>$this->menu,
                     'htmlOptions'=>array('class'=>'operations'),
                  ));
                  $this->endWidget();
                  ?>
               <?php endif;?>
               </div>
            </div>
         </div>
      </div>
      
      <?php if ($this->user->isAdmin):?>
        <br/>
        <div class="buttons admin">
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'items'=>Array(
                    array('label'=>Yii::t('template', 'NEWS'), 'url'=>array('/news/admin'), 'linkOptions'=>array('class'=>'profileBtn')),
                    array('label'=>Yii::t('template', 'USERS'), 'url'=>array('/userGroups/'), 'linkOptions'=>array('class'=>'profileBtn')),
                    array('label'=>Yii::t('template', 'HOLES'), 'url'=>array('/holes/admin'), 'linkOptions'=>array('class'=>'profileBtn'), 'visible'=>$this->user->groupName=='root'),
                    array('label'=>Yii::t('template', 'HOLETYPES'), 'url'=>array('/holeTypes/index'), 'linkOptions'=>array('class'=>'profileBtn')),
                    array('label'=>Yii::t('template', 'RESULT_OF_REQUESTS'), 'url'=>array('/holeAnswerResults/index'), 'linkOptions'=>array('class'=>'profileBtn')),
                    array('label'=>Yii::t('template', 'COMMENTS'), 'url'=>array('/comments/comment'), 'linkOptions'=>array('class'=>'profileBtn')),
                    array('label'=>Yii::t('template', 'EVENT'), 'url'=>array('/event/ListEvents'), 'linkOptions'=>array('class'=>'profileBtn')),
                ),
                'htmlOptions'=>array('class'=>'operations'),
            ));
            ?>
        </div>
      <?php endif;?>
   </div>
</div>

<a href="http://stfalcon.github.io/euromaidan/" class="em-ribbon" style="position: absolute; left:0; top:0; width: 90px; height: 90px; background: url('http://stfalcon.github.io/euromaidan/img/em-ribbon.png'); z-index: 2013; border: 0;" title="Розмісти стрічку з символікою України і ЄС на своєму сайті!" target="_blank"></a>
<div class="mainCols">
	<?php echo $content; ?>
</div>		
	
<?php $this->endContent(); ?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        var regex = /profile\/myarea/;
        if (regex.exec(window.location.href)) {
            //if (jQuery('.buttons.usermenu-container li a[href="/holes/myarea/"]')) {
                jQuery('.buttons.usermenu-container li a[href="/holes/myarea/"]').parent().addClass('active');
           // }
        }
    });
</script>
