<div>
<?php
$this->title = Yii::t("template", "PAYD_TITLE");
$this->pageTitle = Yii::app()->params['langtitle'].$this->title;
$this->layout='//layouts/header_blank';


foreach($holes as $hole)
{
if ($hole->STATE!=Holes::STATE_FIXED) {
    echo Yii::t("template","PAYD_INTRO").'<br /><br />';
    if ($hole->USER_ID == $this->user->id || Yii::app()->user->level >=50) {
      echo Yii::t("template","PAYD_CHECK").'(<a href="/holes/update/'.$hole->ID.'">'.Yii::t("template","PAYD_UPDATE").'</a>)<br /><br />';
    }                                               
    echo Yii::t("template","PAYD_COMMENT").' '.$hole->COMMENT1.'<br /><br />';

} else {
   echo Yii::t("template","PAYD_FIXED").'<br /><br />';
}

echo Yii::t("template","PAYD_ADDRESS").' '.$hole->ADDRESS.'<br /><br />';




?>

<?php  
if (Yii::app()->params['liqpay_sandbox'] == true) { 
  echo ('<B>Увага!</b> Режим емуляції платежів! Платіж насправді не буде виконано. Це означає, що гроші не будуть перераховані УкрЯмі та юристи не будуть займатися вашою справою. Причина, скоріше за все, в профілактичних роботах на сервері УкрЯми. Якщо ваша справа термінова, напишіть листа на info@ukryama.com<br>'); 
}
?>
<div style="display: inline-block;">
<div style="display: inline-flex;">
<form method="POST" accept-charset="utf-8" action="https://www.liqpay.ua/api/pay">
<input type="hidden" name="public_key" value="<?php echo Yii::app()->params['public_key'] ?>" />

<input type="hidden" id="amount" name="amount" value="27" />

<input id="amount_i" name="amount_i" type=range min=24 max=500 value=27> 
    <span class="sub">max</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b name=range id=range>27</b> грн. 
    (<i><a href="javascript:void(0);" onClick="if(ownr03.style['display']=='none') {ownr03.style['display']='inline'}else{ownr03.style['display']='none'}"> свій варіант</a></i> <input name="ownr03" id="ownr03" style="display:none">)</td></tr>

        <script type="text/javascript">
    var p = document.getElementById("amount_i"),
        a = document.getElementById("amount"),
        cp_amount = document.getElementById("amount_cp"),
        res = document.getElementById("range");
        
        p.addEventListener("input", function() {
            cp_amount = document.getElementById("amount_cp");
            res.innerHTML = p.value;
            a.value = p.value;
            cp_amount.value = p.value;
            console.log("New1 value", p.value);
        }, false);

    var t = document.getElementById("ownr03");
        t.addEventListener("input", function() {
            cp_amount = document.getElementById("amount_cp");
            p.value = t.value;
            res.innerHTML = t.value;
            a.value = t.value;
            cp_amount.value = t.value;
            console.log("New2 value", t.value);
        }, false);
        function setPayAmount(n) {
            cp_amount = document.getElementById("amount_cp");
            p.value = n;
            res.innerHTML = n;
            a.value = n;
            cp_amount.value = n;
            console.log("Pay value", t.value);
        };
    </script>

<input type="hidden" name="currency" value="UAH" />
<input type="hidden" name="description" value="Дефект № <?php echo $hole->ID ?> (<?php echo $hole->STATE ?>) от <?php echo $hole->user->name.' '.$hole->user->last_name ?>" />
<input type="hidden" name="type" value="buy" />
<input type="hidden" name="pay_way" value="card,delayed" />
<input type="hidden" name="language" value="ru" /> <br />

<input type="hidden" name="sandbox" value="<?php echo Yii::app()->params['liqpay_sandbox']?>" />

<input type="hidden" name="server_url" value="<?php echo Yii::app()->params['liqpay_server_url']?>" />
<input type="image" src="//static.liqpay.ua/buttons/p1ru.radius.png" name="btn_text" />
</form>
</div>
<div style="display: inline-block">
<style>
.narrow {
  max-width: 100px;
}
.wide {
  width: 400px;
}
.onerow {
  display: block;
}
.middle {
margin: 30px;
padding: 40 px;
width: auto
}
.demo-card-wide.mdl-card {
  width: 90%;
  margin: auto;
}
.cntr {
  margin: auto;
  text-align: center;
}

</style>
<!-- form action ="https://www.ingenia.nz/route/98d808d0b0/ordercreate" method="POST" id="frm" name="frm" -->
<!--CoinyID: <input type="text" name="coiny_id" value="176"><br> -->
<?
$addr = "f915b2c6cb"; // test
//$addr = "98d808d0b0"; // Prod
$key = Yii::app()->params['coinypay_key_test'];
//$key = Yii::app()->params['coinypay_key'];
$seller_id = "w3309rbvg"; // Test
//$seller_id = "w7970kmgr"; //production UkrYama
$inner_id = $hole->ID.'_'.rand(10000,99999);
$description = "Дефект № ".$hole->ID ." (". $hole->STATE.") от ".$hole->user->name." ".$hole->user->last_name;
$s = $seller_id.';'.$inner_id;
$sign = hash_hmac("md5", $s, $key);
?>
<form action ="https://www.ingenia.nz/route/<? echo $addr ?>/ordercreate" method="POST" id="frm" name="frm">
  <input type="hidden" name="s" value = "<? echo $s?>">
  <input type="hidden" id="amount_cp" name="amount" value = "27">
  <input type="hidden" id="innerid_cp" name="innerid" value = "<?php echo $inner_id ?>">
  <input type="hidden" id="description" name="description" value="<? echo $description ?>" />
  <input type="hidden" id="content" name="content" value = "Яма №"<?php echo $hole->ID ?>>
  <input type="hidden" name="seller" value="<? echo $seller_id ?>"><br>
  <input type="hidden" name="signature" value="<? echo $sign?>">

<!--input type="image" src="http://coinypay.ingenia.nz/images/CoinyPay_button1_small.png" onclick="submitForm();" -->

<div class="cntr middle" style="display: inline;">
<input type="button" value="50 грн" onclick="ownr03.value = 50; setPayAmount(50); return false;">
</div>
<div class="cntr middle" style="display: inline;">
<input type="button" value="100 грн" onclick="ownr03.value = 100; setPayAmount(100); return false;">
</div>
<div class="cntr middle" style="display: inline;">
<input type="button" value="150 грн" onclick="ownr03.value = 150; setPayAmount(150); return false;">
</div>
<div class="cntr middle" style="display: inline;">
<input type="button" value="250 грн" onclick="ownr03.value = 250; setPayAmount(250); return false;">
</div>
<div class="cntr middle" style="display: inline;">
<input type="button" value="500 грн" onclick="ownr03.value = 500; setPayAmount(500); return false;">
</div>
<div class="cntr middle" style="display: inline;">
<input type="button" value="1000 грн" onclick="ownr03.value = 1000; setPayAmount(1000); return false;">
</div>

</form>
</div>
<script>
var __cp = {};
__cp.tmp_key = null;
function submitForm() {
  document.frm.target = "myActionWin";
  window.open("","myActionWin","width=500,height=300,toolbar=0");
  document.frm.submit();
  __cp.tmp_key = setInterval(updateBill, 5000);
  return true;
}
  function updateBill () { // Use your payment status function here
      $.post('coinypaystatus', {innerid: document.frm.innerid.value, signature:''}, function(response){
            result.innerHTML = JSON.stringify(unescape(response));
            if (['paid', 'cancelled', ''].includes (response.status)) {
                result.innerHTML = 'Payment status: ' + response.status;
                clearInterval (__cp.tmp_key);
                if (response.status == 'paid') {
                    setTimeout(()=>{window.location="done?holeid="+<?php echo $hole->ID ?>;}, 3000);

                }
		// Proceed with payment result here: redirect or whatever else
            }
      },'json');
  }

</script>
<div id="result">

</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
<script type="text/javascript" src="https://blockchain.info/Resources/js/pay-now-button.js"></script>
<div style="font-size:16px;margin:0 auto;width:300px" class="blockchain-btn"
     data-address="1KBrR6githC3Fdej9wheRBHQkx55GQJr9R"
     data-shared="false">
    <div class="blockchain stage-begin">
        <img src="https://blockchain.info/Resources/buttons/donate_64.png"/>
    </div>
    <div class="blockchain stage-loading" style="text-align:center">
        <img src="https://blockchain.info/Resources/loading-large.gif"/>
    </div>
    <div class="blockchain stage-ready">
         <p align="center">Please Donate To Bitcoin Address: <b>[[address]]</b></p>
         <p align="center" class="qr-code"></p>
    </div>
    <div class="blockchain stage-paid">
         Donation of <b>[[value]] BTC</b> Received. Thank You.
    </div>
    <div class="blockchain stage-error">
        <font color="red">[[error]]</font>
    </div>
</div>

<?php } ?>
</div>