<?php

/**
 * This is the model class for table "{{payments}}".
 *
 * The followings are the available columns in table '{{payments}}':
 * @property integer $id
 * @property string $user_id
 * @property integer $hole_id
 * @property double $amount
 * @property string $date
 * @property string $status
 * @property string $type
 * @property iineger $transaction_id
 * @property varchar $currency
 * The followings are the available model relations:
 * @property UsergroupsUser $user
 */
class Payments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{payments}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hole_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			
                    array('description', 'length', 'max'=>500),
                          array('transaction_id', 'length', 'max'=>30),
			array('status, type, currency', 'length', 'max'=>15),
			array('date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, hole_id, amount, date, status, type, transaction_id, description, currency', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'UsergroupsUser', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			//'hole_id' => Yii::t('template','hole_id'),
			'amount' => Yii::t('template','amount'),
			'date' => Yii::t('template','date'),
			'status' => Yii::t('template','status'),
			'type' => Yii::t('template','type'),
                        'transaction_id' => Yii::t('template','transaction_id'),
                        'description' => Yii::t('template','description'),
                        'currency' => Yii::t('template','CURRENCY'),
                    
                    
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
		$criteria->compare('hole_id',$this->hole_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('type',$this->type,true);
                $criteria->compare('transaction_id',$this->transaction_id,true);
                $criteria->compare('description',$this->description,true);
                $criteria->compare('currency',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Payments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
