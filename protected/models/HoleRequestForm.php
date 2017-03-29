<?php

class HoleRequestForm extends CFormModel
{
	public $lang;
	public $form_type;
	public $to_name;
	public $to_address;
	public $from;
	public $postaddress;
	public $address;
	public $comment;
	public $signature;
	public $html;
	public $pdf;
	public $gibdd;
	public $gibdd_reply;
	public $application_data;
	public $holes=Array();
	public $printAllPictures=true;


	public function rules()
	{
		return array(
			// username and password are required
			//array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('html, pdf, printAllPictures', 'boolean'),
			// password needs to be authenticated
			array('form_type, lang, to_name, to_address, from, postaddress, address, comment, signature, application_data, gibdd, gibdd_reply', 'length'),
			array('holes', 'safe'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'lang'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_LANG'),
			'to_name'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_TO_NAME'),
			'to_address'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_TO_ADDRESS'),
			'from'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_FROM'),
			'postaddress'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_POSTADDRESS'),
			'address'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_ADDRESS'),
			'comment'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_COMMENT'),
			'signature'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_SIGNATURE'),
			'email'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_EMAIL'),
			'printAllPictures'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_PRINT_PICTURES'),
		);
	}

}
