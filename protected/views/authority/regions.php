<?php
$this->breadcrumbs=array(
	'Regions',
);
?>
<script>
function changeLang(x){
	$.post("/authority/",{"_lang":x});
	location.reload();
}
</script>
<input type=button onClick="changeLang('ua')" value="Ukr">|<input type=button onClick="changeLang('ru')" value="Rus"><br>
<?php
echo "<b>".$regions["name"]."</b><br>\n";
echo "<ul>";
foreach($regions->children as $area){
	echo "<li>".$area["name"]."</li>\n";
	if(count($area->children)>0){
		echo "<ol>";
		foreach($area->children as $child){
			echo "<li>".$child["name"]."</li>\n";
		}
		echo "</ol>";
	}
}
echo "</ul>";
?>
