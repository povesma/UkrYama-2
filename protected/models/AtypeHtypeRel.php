<?php

/**
 * This is the model class for table "yii_atype_htype_rel".
 *
 * The followings are the available columns in table 'yii_atype_htype_rel':
 * @property integer $ht_id
 * @property integer $at_id
 */
class AtypeHtypeRel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yii_atype_htype_rel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ht_id, at_id', 'required'),
			array('ht_id, at_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ht_id, at_id', 'safe', 'on'=>'search'),
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
			'atype'=>array(self::BELONGS_TO,'AuthorityType','at_id'),
			'htype'=>array(self::BELONGS_TO,'HoleTypes','ht_id'),
			'auth'=>array(self::BELONGS_TO,'Authority','at_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ht_id' => 'Hole Type',
			'at_id' => 'Authoryty Type',
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

		$criteria->compare('ht_id',$this->ht_id);
		$criteria->compare('at_id',$this->at_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AtypeHtypeRel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
