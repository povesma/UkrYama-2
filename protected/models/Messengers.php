<?php

/**
 * This is the model class for table "{{messengers}}".
 *
 * The followings are the available columns in table '{{messengers}}':
 * @property integer $id
 * @property string $user
 * @property integer $messenger
 * @property string $uin
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property MessengersItems $messenger0
 * @property UsergroupsUser $user0
 */
class Messengers extends CActiveRecord
{
    
    public $_userid;
    
    public $_facebook;
       
    public $_viber;
    
    public $_telegram;
      
    public $_whatsapp;
       
    public $_twitter;
    
    public $_instagram;
    
    public $_email;

    public $_vk;
    
    public $_phone;
    
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{messengers}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('messenger, status', 'numerical', 'integerOnly'=>true),
			array('user', 'length', 'max'=>20),
			array('uin', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user, messenger, uin, status', 'safe', 'on'=>'search'),
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
			'messenger0' => array(self::BELONGS_TO, 'MessengersItems', 'messenger'),
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
			'messenger' => 'Messenger',
			'uin' => 'Uin',
			'status' => 'Status',
		);
	}

        
                
        protected function getUsersMessenger($userid)
        {
                {
        
     $messsangers_id  = array(1,2,3,4,5,6,7,8,9);
     
     foreach ($messengerids as $m) {
         $ms = Messengers::model()->find("user = :user_id and messenger = :messengerID", 
                                       array('user_id'=> $this->_userid, 'messengerID'=>$m));
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
                case 7:
                    $this->_vk = $ms;
                    break;
                case 8:
                    $this->_instagram = $ms;
                    break;
                case 9:
                    $this->_phone = $ms;
                    break;
                default:
                    throw new CHttpException(500, 'Messengers check error');  
                    
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
		$criteria->compare('messenger',$this->messenger);
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
	 * @return Messengers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
