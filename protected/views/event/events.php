<?php if ($this->user->isAdmin):?>
	<a href="/event/AdminGT">Редактировать Дерево Недочетов</a><br>
<?php endif;?>
Список заявлений<br>

<?php
        	$dir = dirname(__FILE__) . '/assets';
	        $assetsDir = Yii::app()->assetManager->publish($dir);
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($assetsDir . '/js/bootstrap.min.js');
		$cs->registerScriptFile($assetsDir . '/js/jquery.min.js');
		$cs->registerScriptFile($assetsDir . '/js/jquery-ui.min.js');
		$cs->registerCssFile($assetsDir . '/css/bootstrap.css');
	        $assetsDir = Yii::app()->assetManager->publish($dir);
?>
<style>
.carousel-control {
  position: absolute;
  top: 40%;
  left: 15px;
  width: 40px;
  height: 40px;
  margin-top: -20px;
  font-size: 60px;
  font-weight: 100;
  line-height: 30px;
  color: #ffffff;
  text-align: center;
  background: #222222;
  border: 3px solid #ffffff;
  -webkit-border-radius: 23px;
     -moz-border-radius: 23px;
          border-radius: 23px;
  opacity: 0.5;
  filter: alpha(opacity=50);
}
td{
	padding:10px;
	width:400;
}
.event-box{
	padding:10px;
	width:400px;
	border: 15px solid #ccc;
	background:#ccc;
	-webkit-border-image: radial-gradient(90,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0.65) 24%,rgba(0,0,0,0) 84%,rgba(0,0,0,0) 100%);
	   -moz-border-image: radial-gradient(90,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0.65) 24%,rgba(0,0,0,0) 84%,rgba(0,0,0,0) 100%);
	     -o-border-image: radial-gradient(90,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0.65) 24%,rgba(0,0,0,0) 84%,rgba(0,0,0,0) 100%);
	        border-image: radial-gradient(90,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0.65) 24%,rgba(0,0,0,0) 84%,rgba(0,0,0,0) 100%);

	-webkit-border-radius: 23px;
	   -moz-border-radius: 23px;
	     -o-border-radius: 23px;
		border-radius: 23px;

}
.event-box h4{
	color:#000;
}
.comment{
	padding-top:10px;
	font-size:16px;
}
</style>
<script>
function showEvent(id){
	document.location.href ="/event/ViewEvent/"+id;

}
</script>
<table>
<tr>
<?php
$n=0;
foreach($events as $event){
$i=0;
if($n==2){
	echo "<tr>";
}
?>
<td>
<div class="event-box">
<h4><?= $event['address'] ?></h4>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="carousel slide" id="carousel-<?= $event['id'] ?>">
				<div class="carousel-inner">
					<?php
					foreach($event['media'] as $file){
						if($file['type']==0){
					?>
					<?= $i==0?'<div class="item active">':'<div class="item">' ?>
						<img style="cursor:pointer" alt="" onClick="showEvent(<?= $event['id'] ?>)" height=300 src="<?= dirname($file['path']).'/small.'.basename($file['path']) ?>" />
					</div>
					<?php
						$i++;
						}
					}
					?>
				</div>
				<?php if($i>1){ ?>
				<a data-slide="prev" href="#carousel-<?= $event['id'] ?>" class="left carousel-control">‹</a> <a data-slide="next" href="#carousel-<?= $event['id'] ?>" class="right carousel-control">›</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="comment"><?= $event['message'] ?></div>
</div>
</td>
<?php
if($n==1){
	echo "</tr>";
	$n=0;
}else{$n++;}
}
?>
</tr></table>
