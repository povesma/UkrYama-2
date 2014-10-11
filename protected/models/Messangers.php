<?php

/**
 * This is the model class for table "{{messangers}}".
 *
 * The followings are the available columns in table '{{messangers}}':
 * @property integer $id
 * @property string $user
 * @property integer $messanger
 * @property string $uin
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property MessangersItems $messanger0
 * @property UsergroupsUser $user0
 */
class Messangers extends CActiveRecord
{
    
    protected $_userid;
    
    protected $_facebook;
       
    protected $_viber;
    
    protected $_telegram;
      
    protected $_whatsapp;
       
    protected $_twitter;
    
    protected $_instagram;
    
    protected $_email;
    
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{messangers}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('messanger, status', 'numerical', 'integerOnly'=>true),
			array('user', 'length', 'max'=>20),
			array('uin', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user, messanger, uin, status', 'safe', 'on'=>'search'),
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
			'messanger0' => array(self::BELONGS_TO, 'MessangersItems', 'messanger'),
			'user0' => array(self::BELONGS_TO, 'UsergroupsUser', 'user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user' => 'User',
			'messanger' => 'Messanger',
			'uin' => 'Uin',
			'status' => 'Status',
		);
	}

        
                
        protected function getUsersMessanger($userid)
        {
                {
        
     $messsangers_id  = array(1,2,3,4,5,6);
     
     foreach ($messangerids as $m) {
         $ms = Messangers::model()->find("user = :user_id and messanger = :messangerID", 
                                       array('user_id'=> $this->_userid, 'messangerID'=>$m));
         if($ms) 
         {
          switch ($m){
                case 1:
                    $this->_email = $ms;
                    break;
                case 2:
                    $this->_whatsapp = $ms;
                    break;
                case 3:
                    $this->_telegram = $ms;
                    break;
                case 4:
                    $this->_facebook = $ms;
                    break;
                case 5:
                    $this->_twitter = $ms;
                    break;
                case 6:
                    $this->_viber = $ms;
                    break;
                default:
                    throw new CHttpException(500, 'Messangers check error');  
                    
                    }
            }
    
        }
    }

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
		$criteria->compare('user',$this->user,true);
		$criteria->compare('messanger',$this->messanger);
		$criteria->compare('uin',$this->uin,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Messangers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
