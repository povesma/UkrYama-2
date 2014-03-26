Категорiя недолiку:
<ul>
<?php
foreach($event['type'] as $one){
	foreach($tree as $node){
		if($one['node']==$node['id'])
			echo "<li>".$node['name']." - ".$node['description']."</li>";
	}
}
echo "</ul>";
echo "Повiдомлення: ".$event['message']."\n<br>Адреса: ".$event['address']."\n<br>";
?>
<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $event['lat'] ?>,<?= $event['lng'] ?>&zoom=14&size=400x400&markers=color:red%7Clabel:Недолiк|<?= $event['lat'] ?>,<?= $event['lng'] ?>&sensor=false"><br>
<?php
foreach($event['media'] as $media){
	if($media['type']==0)
		echo "<img src='".dirname($media['path'])."/medium.".basename($media['path'])."'>\n<br>";
	if($media['type']==1)
		echo "<video width=\"320\" height=\"240\" controls><source src='".$media['path']."' type=\"video/webm\"></video>\n<br>";

}
echo "Повiдомив: ".$event['user']['name']." ".$event['user']['last_name'];
?>

