<?php
$this->title = Yii::t("template", "PAYD_TITLE");
$this->pageTitle = Yii::app()->params['langtitle'].$this->title;
$this->layout='//layouts/header_blank';


echo Yii::t("template","PAYD_INTRO").'<br /><br />';
foreach($holes as $hole)
{
echo Yii::t("template","PAYD_CHECK").'(<a href="/holes/update/'.$hole->ID.'">'.Yii::t("template","PAYD_UPDATE").'</a>)<br /><br />';

echo Yii::t("template","PAYD_ADDRESS").' '.$hole->ADDRESS.'<br /><br />';

echo Yii::t("template","PAYD_COMMENT").' '.$hole->COMMENT1.'<br /><br />';



?>

<?php  
if (Yii::app()->params['liqpay_sandbox'] == true) { 
  echo ('<B>Увага!</b> Режим емуляції платежів! Платіж насправді не буде виконано. Це означає, що гроші не будуть перераховані УкрЯмі та юристи не будуть займатися вашою справою. Причина, скоріше за все, в профілактичних роботах на сервері УкрЯми. Якщо ваша справа термінова, напишіть листа на info@ukryama.com<br>'); 
}
?>

<form method="POST" accept-charset="utf-8" action="https://www.liqpay.com/api/pay">
<input type="hidden" name="public_key" value="<?php echo Yii::app()->params['public_key'] ?>" />

<input id="amount" name="amount" type=range min=20 max=200 value=20 > 
    <span class="sub">max</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b name=range id=range>20</b> грн. 
        <script type="text/javascript">
    var p = document.getElementById("amount"),
        res = document.getElementById("range");
        
        p.addEventListener("input", function() {
            res.innerHTML = p.value;
        }, false);
    </script>
    (<i><a href="javascript:void(0);" onClick="if(ownr03.style['display']=='none') {ownr03.style['display']='inline'}else{ownr03.style['display']='none'}"> свій варіант</a></i> <input name="ownr03" id="ownr03" style="display:none">)</td></tr>

<input type="hidden" name="currency" value="UAH" />
<input type="hidden" name="description" value="Дефект № <?php echo $hole->ID ?> от <?php echo $hole->user->name.' '.$hole->user->last_name ?>" />
<input type="hidden" name="type" value="buy" />
<input type="hidden" name="pay_way" value="card,delayed" />
<input type="hidden" name="language" value="ru" /> <br />

<input type="hidden" name="sandbox" value="<?php echo Yii::app()->params['liqpay_sandbox']?>" />

<input type="hidden" name="server_url" value="<?php echo Yii::app()->params['liqpay_server_url']?>" />
<input type="image" src="//static.liqpay.com/buttons/p1ru.radius.png" name="btn_text" />
</form>

<?php } ?>