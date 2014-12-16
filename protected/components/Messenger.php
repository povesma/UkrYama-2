<?php

/*
 * Клас являє собою єдиний інтерфейс для відправки повідомленнь
 * Class Messenger
 *
 * @author Poremchuk Evgeniy
 */

class Messenger extends CComponent {
    
    // У властивостях класу тримаємо ексземпляри моделі окремих месенджерів користувача
    
    public $_userid;
    
    public $_email;  // 1 
    public $_email_status;

    public $_whatsapp;  // 2
    public $_whatsapp_status;
       
    public $_telegram; // 3
    public $_telegram_status;
      
    public $_facebook; // 4
    public $_facebook_status;
       
    public $_twitter; // 5 
    public $_twitter_status;
    
    public $_viber; // 6
    public $_viber_status;
    
    public $_vk; // 7
    public $_vk_status;

    public $_instagram; // 8
    public $_instagram_status;
    
    // Єдина строчка відсилання нотифікації для усього сайту (Messenger::send($userid, $subject, $message)) 
    public function condence($userid, $subject = NULL, $message)
    {
        $this->_userid = $userid;
        
        $messengerids = array(1,2,3,4,5,6,7); // ID месенджерів
        
        $this->checkMessenger($messengerids); // Перевіряємо які месенджери є у користувача і на які можна відсидати нотифікацію
        $prm = Yii::app()->params['email'];
        
        if(Yii::app()->params['email']) $this->email($subject, $message);

        if(Yii::app()->params['facebook']) $this->facebook($message);
        
        if(Yii::app()->params['viber']) $this->viber($message);
        
        if(Yii::app()->params['telegram']) $this->telegram($message);
        
        if(Yii::app()->params['whatsapp']) $this->whatsapp($message);
        
        if(Yii::app()->params['twitter']) $this->twitter($message);
        
        if(Yii::app()->params['instagram']) $this->instagram($message);
        
    }
    
    // Відправляємо мило користувачу
    protected function email($subject, $message)
    {
	$headers = "MIME-Version: 1.0\r\nFrom: " . Yii::app()->params['adminEmail'] . "\r\nReply-To: " . Yii::app()->params['adminEmail'] . "\r\nContent-Type: text/html; charset=utf-8";
//	Yii::app()->request->baseUrl = Yii::app()->request->hostInfo;

	if($subject === NULL) $subject = "Від УкрЯми: повідомлення";
	$d1 = date('Y-m-d H:i:s');
	error_log ($d1.": Mail to send: ".$this->_email->uin." <- ".$subject."\n", 3, "php-log.log");
	$res = mail($this->_email->uin, $subject, $message, $headers);
	error_log ("Send result: ".$res."\n", 3, "php-log.log");
                                                   
    }
    
    // Відправляємо повідомлення користувачу в Фейсбук
    protected function facebook($message = NULL)
    {
    
        if($this->_facebook) {          

            //Логіка відправки повідомлення на ФБ користувача ($this->_facebook->uin)
//           echo 'Працює друзі'.$this->_facebook->messenger0->name;
            
        } else {
           
            return false;
        
    }
    }
    
    // Відправляємо повідомлення користувачу в Телеграм
    
        protected function telegram($message = NULL)
    {
    
        if($this->_telegram) {          

            //Логіка відправки повідомлення на Telegram користувача ($this->_telegram->uin)
           //echo 'Працює друзі'.$this->_telegram->messenger0->name;
            
        } else {
            
             return false;
    }
    }
    
    // Відправляємо повідомлення користувачу в Вайбер
    
    protected function viber($message = NULL)
    {
    
        if($this->_viber) {          

            //Логіка відправки повідомлення 
            
        } else {
            
             return false;
    }
    }
    
    // Відправляємо повідомлення користувачу в УотсАп
    
    protected function whatsapp($message = NULL)
    {
    
        if($this->_whatsapp) {          

            //Логіка відправки повідомлення 
            
        } else {
            
             return false;
    }
    }
    
    // Відправляємо повідомлення користувачу в Твіттер
    
    protected function twitter($message = NULL)
    {
        if($this->_twitter) {          

            //Логіка відправки повідомлення 
            
        } else {
            
             return false;
    }
      
    }
    
    // Відправляємо повідомлення користувачу в Інстаграм
    
     protected function instagram($message = NULL)
    {
        if($this->_instagram) {          

            //Логіка відправки повідомлення 
            
        } else {
            
             return false;
    }
    }
    
    /** 
     * Перевіряємо по списку чи вводив користувач свої месенджери та чи активував на них розсилання
     */
    protected function checkMessenger($messengerids) 
    {

     
     foreach ($messengerids as $m) {
         $ms = Messengers::model()->find("user = :user_id and messenger = :messengerID and status = 1", 
                                       array('user_id'=> $this->_userid, 'messengerID'=>$m));
         // беремо емейл зі старої таблиці користувачів
	 $user = UserGroupsUser::model()->findByPk($this->_userid);
	 if ($user) {
            $this->_email = $user->email;
	 }

         if($ms) 
         {
          $sms = $ms->uin;
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
                default:
		    error_log ("Inapproprite messengerID: ".$m."\n", 3, "php-log.log");
                    throw new CHttpException(500, 'Messengers check error');  
                    
                    }
            } else {
	    }
    
        }
    }

    /**
     * Користувацька функція, що обробляє запит на відправку повідомлення
     * Працює в любому місці сайту і викликається ось так:  Messenger::send(ID користувача, "Тема повідомлення або без теми", "Текст повідомлення");
     * @param int $userid
     * @param string $subject
     * @param string $message
     */
    
    public static function send($userid, $subject = NULL, $message)
    {
    	$mod = new Messenger;
    	$mod->condence($userid, $subject, $message);
    
    }
    
    
    /** -------------------------------------
     * Працюємо з заповненням полів профіля
      --------------------------------------- */
public static function checkProf($userid)
{
	$m = new Messenger();
	
	$m->condenceProf($userid);
	
	return $m;
}
    // Єдина строчка відсилання нотифікації для усього сайту (Messenger::send($userid, $subject, $message))
    public function condenceProf($userid)
    {
    	$this->_userid = $userid;
    
    	$messengerids = array(1,2,3,4,5,6,7); // ID месенджерів
    
    	$this->checkMessengersProf($messengerids); // Перевіряємо які месенджери є у користувача і на які можна відсидати нотифікацію
    	
    
    }

    /**
     * Перевіряємо по списку чи вводив користувач свої месенджери та чи активував на них розсилання
     */
    protected function checkMessengersProf($messengerids)
    {
    
    	 
    	foreach ($messengerids as $m) {
    		$ms = Messengers::model()->find("user = :user_id and messenger = :messengerID",
    				array('user_id'=> $this->_userid, 'messengerID'=>$m));
    		if($ms)
    		{
    			switch ($m){
    				case 1:
    					$this->_email = $ms->uin;
    					$this->_email_status = $ms->status;
    					break;
    				case 2:
    					$this->_whatsapp = $ms->uin;
    					$this->_whatsapp_status = $ms->status;
    					break;
    				case 3:
    					$this->_telegram = $ms->uin;
    					$this->_telegram_status = $ms->status;
    					break;
    				case 4:
    					$this->_facebook = $ms->uin;
    					$this->_facebook_status = $ms->status;
    					break;
    				case 5:
    					$this->_twitter = $ms->uin;
    					$this->_twitter_status = $ms->status;
    					break;
    				case 6:
    					$this->_viber = $ms->uin;
    					$this->_viber_status = $ms->status;
    					break;
    				case 7:
    					$this->_vk = $ms->uin;
    					$this->_vk_status = $ms->status;
    					break;
    				default:
    					throw new CHttpException(500, 'Messengers check error');
    
    			}
    		}
    
    	}
    }

    
    //------------------------------------------------------------------//
    // Функція для тесту
    //------------------------------------------------------------------//
public function test($userid,$messengerID)
{
    $ms = Messengers::model()->find("user = :user_id and messenger = :messengerID", 
                                       array('user_id'=> $userid, 'messengerID'=>$messengerID));
//echo $ms->messenger0->name;
    $this->_messengercalss = $ms;
return $this->_messengercalss;
}



}