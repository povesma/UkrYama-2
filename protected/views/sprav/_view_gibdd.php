<h2><?php echo $data->name; ?></h2>

<div style="clear:both"></div>
	<?php if(strlen($data->o_name)>0): ?>
	ФИО:&nbsp;<?= $data->o_name; ?><br />
	<?php endif; ?>
	<?php if(strlen($data->o_pos)>0): ?>
	Должность:&nbsp;<?= $data->o_pos; ?><br />
	<?php endif; ?>
	<?php if(strlen($data->address)>0): ?>
	Адрес:&nbsp;<?= $data->address; ?><br />
	<?php endif; ?>
	<?php if(strlen($data->o_phone)>0): ?>
	Телефон дежурной части:&nbsp;<?= $data->o_phone; ?><br />
	<?php endif; ?>
	<?php if(strlen($data->o_fax)>0): ?>
	Fax:&nbsp;<?= $data->o_fax; ?><br />
	<?php endif; ?>
