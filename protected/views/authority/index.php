<?php
/* @var $this EventController */

$this->breadcrumbs=array(
	'Authorities',
);
?>
<table style="border:solid 1px;">
	<tr><td>ID</td><td>Язык</td><td>Тип</td><td>Регион</td><td>Название</td><td>Адрес</td><td>Индекс</td><td>Имя Начальника</td><td>Позиция Начальника</td><td>Телефон</td><td>Факс</td><td>email</td></tr>
<?php 
foreach($model->findAll() as $auth):
?>
	<tr><td><?= $auth->id ?></td><td><?= $auth->lang ?></td><td><?= $auth->atype->type ?></td><td><?= $auth->region->name ?></td><td><?= $auth->name ?></td><td><?= $auth->address ?></td><td><?= $auth->index ?></td><td><?= $auth->o_name ?></td><td><?= $auth->o_pos ?></td><td><?= $auth->o_phone ?></td><td><?= $auth->o_fax ?></td><td><?= $auth->o_email ?></td></tr>
<?php endforeach; ?>
</table>
