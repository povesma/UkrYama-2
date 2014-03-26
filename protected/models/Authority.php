<?php

/**
 * This is the model class for table "yii_authority".
 *
 * The followings are the available columns in table 'yii_authority':
 * @property integer $id
 * @property string $lang
 * @property integer $type
 * @property integer $region_id
 * @property string $name
 * @property string $address
 * @property string $index
 * @property string $o_name
 * @property string $o_pos
 * @property string $o_phone
 * @property string $o_email
 * @property string $o_fax
 */
class Authority extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yii_authority';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, lang, type, region_id, name, address, index', 'required'),
			array('id, type, region_id', 'numerical', 'integerOnly'=>true),
			array('lang', 'length', 'max'=>3),
			array('name, address', 'length', 'max'=>255),
			array('index', 'length', 'max'=>10),
			array('o_name, o_pos, o_email', 'length', 'max'=>100),
			array('o_phone, o_fax', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, lang, type, region_id, name, address, index, o_name, o_pos, o_phone, o_email, o_fax', 'safe', 'on'=>'search'),
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
			'atype'=>array(self::BELONGS_TO, "AuthorityType", array('type','lang')),
			'region'=>array(self::BELONGS_TO, "Region", array('region_id','lang')),
			'children'=>array(self::HAS_MANY, "AuthorityRelation", 'id' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'lang' => 'Язык',
			'type' => 'Тип',
			'region_id' => 'Регион',
			'name' => 'Имя',
			'address' => 'Адрес',
			'index' => 'Почтовый Индекс',
			'o_name' => 'Имя Начальника',
			'o_pos' => 'Позиция Начальника',
			'o_phone' => 'Телефон',
			'o_email' => 'Email',
			'o_fax' => 'Fax',
		);
	}
	public function parents($lang){
		$parents_id=AuthorityRelation::model()->findAll('id2=:id',array(':id'=>$this->id));
		$parents=array();
		foreach($parents_id as $id){
			$parent=$this->findByPk(array('id'=>$id->id1,'lang'=>$lang));
			array_push($parents,$parent);
		}
		return $parents;
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
		$criteria->compare('type',$this->type);
		$criteria->compare('region_id',$this->region_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('index',$this->index,true);
		$criteria->compare('o_name',$this->o_name,true);
		$criteria->compare('o_pos',$this->o_pos,true);
		$criteria->compare('o_phone',$this->o_phone,true);
		$criteria->compare('o_email',$this->o_email,true);
		$criteria->compare('o_fax',$this->o_fax,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Authority the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
