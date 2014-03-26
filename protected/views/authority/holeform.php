<?php if(count($result)): ?>
<form method="POST" name="Print">
<div>For "<?=$holetype->name?>" in "<?=$region->name?>" we've found next authorities responsible:</div>
<?php
	foreach($result as $auth){
		echo "<input type='radio' name='Print[auth]' value='".$auth->id."'>".$auth->name."<br>";
	}
?>
	<input type="hidden" name="Print[holetype]" value="<?= $holetype->id ?>">
	<input type="hidden" name="Print[hole_id]" value="<?= $hole_id ?>">
	<input type="hidden" name="Print[region]" value="<?= $region->id ?>">
	<input type="hidden" name="Print[lang]" value="<?= $lang ?>">
	<input type="submit">
</form>
<?php else: ?>
<div>For "<?=$holetype->name?>" in "<?=$region->name?>" we've found NONE authorities responsible!</div>
<?php endif; ?>
