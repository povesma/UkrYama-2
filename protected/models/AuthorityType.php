<?php

/**
 * This is the model class for table "yii_authority_type".
 *
 * The followings are the available columns in table 'yii_authority_type':
 * @property integer $id
 * @property string $lang
 * @property string $type
 * @property string $alias
 * @property string $description
 */
class AuthorityType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yii_authority_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, lang, type, alias', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('lang', 'length', 'max'=>3),
			array('type, alias', 'length', 'max'=>45),
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, alias, lang, type, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'authority'=>array(self::HAS_MANY,'Authority',array('type','lang')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'lang' => 'Lang',
			'type' => 'Type',
			'alias' => 'Alias',
			'description' => 'Description',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AuthorityType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
