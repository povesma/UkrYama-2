<?php
$this->title = Yii::t('template','thx_page_h1');
//$this->title = Yii::t("template", "MENU_TOP_DONATE");
$this->pageTitle = Yii::app()->params['langtitle'].$this->title;
$this->layout='//layouts/header_blank';

//echo Yii::t("template","PAYD_HOLE");
?>

<?php echo Yii::t('template','thx_page_text'); echo ''?> <br /><br /><br />
<?php  
if (Yii::app()->params['liqpay_sandbox'] == true) { 
  echo ('<B>Увага!</b> Режим емуляції платежів! Платіж насправді не виконано. Це означає, що гроші не перераховані УкрЯмі та юристи будуть займатися вашою справою. Це сталось скоріше за все через профілактичні роботи на сервері УкрЯми. Якщо ваша справа термінова, напишіть листа на info@ukryama.com<br>'); 
}
?>



