<?php

/**
 * This is the model class for table "yii_authority_relation".
 *
 * The followings are the available columns in table 'yii_authority_relation':
 * @property integer $id1
 * @property integer $id2
 * @property integer $rel
 */
class AuthorityRelation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yii_authority_relation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id1, id2', 'required'),
			array('id1, id2, rel', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id1, id2, rel', 'safe', 'on'=>'search'),
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
			'parent_authority'=>array(self::BELONGS_TO,'Authority','id1'),
			'child_authority'=>array(self::BELONGS_TO,'Authority','id2'),
			'parents'=>array(self::HAS_MANY, 'AuthorityRelation', 'id1'),
			'children'=>array(self::HAS_MANY, 'AuthorityRelation', 'id2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id1' => 'Родитель',
			'id2' => 'Ребенок',
			'rel' => 'Rel',
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

		$criteria->compare('id1',$this->id1);
		$criteria->compare('id2',$this->id2);
		$criteria->compare('rel',$this->rel);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AuthorityRelation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
