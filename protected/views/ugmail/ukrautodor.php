<p>Доброго дня, шановний Укравтодор!</p>
<p>Користувач проекту УкрЯма виявив та завантажив на наш веб-сайт дорожній дефект, що, на його думку, знаходиться
у зоні відповідальності Укравтодору.</p>
<p><strong>Адреса дороги з дефектом:</strong> <?php print($model->ADDRESS); ?></p>
<p><strong>Опис:</strong> <?php print($model->COMMENT1); ?></p>

<p><strong>Фото:</strong></p>
<?php foreach($model->pictures_fresh as $picture): ?>
  <img src="<?php print(Yii::app()->createUrl('') . $picture->medium); ?> " />
<?php endforeach; ?>

<p>Детальніше - Яма #<a href="<?php print(Yii::app()->createUrl($model->ID)); ?>"><?php print($model->ID); ?></a>.</p>

<p>Якщо у вас є питання - можете задати їх просто у відповіді на цей лист. Листування може бути опубліковано.</p>

<p>З повагою,<br> 
команда УкрЯми </p>

