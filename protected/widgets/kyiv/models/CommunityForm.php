<?php
class CommunityForm extends CFormModel
{
	public $firstName;
	public $lastName;
	public $email;
	public $message;
	public $address;

	public function rules()
	{
		return array(
			// all fields are mandatory
//			array('firstName, lastName', 'email', 'subject', 'message', 'required'),
		);
	}
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
//			'lang'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_LANG'),
			'firstName'=>'Iм\'я',
			'lastName'=>'Призвище',
			'email'=>'Електронна адреса',
			'message'=>'Опис',
			'address'=>'Адреса мiсця',

		);
	}
} 
