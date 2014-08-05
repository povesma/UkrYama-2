<?php
$this->title = Yii::t('template','thx_page_h1');
//$this->title = Yii::t("template", "MENU_TOP_DONATE");
$this->pageTitle = Yii::app()->params['langtitle'].$this->title;
$this->layout='//layouts/header_blank';

//echo Yii::t("template","PAYD_HOLE");
?>

<?php echo Yii::t('template','thx_page_text'); ?> <br /><br /><br />

