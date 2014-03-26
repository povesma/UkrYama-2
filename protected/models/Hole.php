<?php

class Hole extends CFormModel
{
	public $region;
	public $holetype;

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'region'=>'Регион',
			'holetype'=>'Тип дефекта',
		);
	}

}
