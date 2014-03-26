<?php

class RequestForm extends CFormModel
{
	public $lang;
	public $defect_type;
	public $to_name;
	public $to_address;
	public $to_index;
	public $name_from;
	public $address_from;
	public $index_from;
	public $signature;
	public $html;
	public $pdf;
	public $authority;
	public $application_data;
	public $holes=Array();


	public function rules()
	{
		return array(
			array('html, pdf', 'boolean'),
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
			'to_index'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_TO_INDEX'),
			'name_from'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_FROM'),
			'address_from'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_ADDRESS'),
			'address_index'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_INDEX'),
			'signature'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_SIGNATURE'),
			'defect_type'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_DEFECT_TYPE'),
			'authority'=>Yii::t('holes_view', 'HOLE_REQUEST_FORM_AUTHORITY'),
		);
	}

}
