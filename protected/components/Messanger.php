<?php

/*
 * Клас являє собою єдиний інтерфейс для відправки повідомленнь
 * Class Messanger
 *
 * @author Poremchuk Evgeniy
 */

class Messanger extends CComponent {
    
    // У властивостях класу тримаємо ексземпляри моделі окремих месенджерів користувача
    
    protected $_userid;
    
    protected $_facebook;
       
    protected $_viber;
    
    protected $_telegram;
      
    protected $_whatsapp;
       
    protected $_twitter;
    
    protected $_instagram;
    
    protected $_email;
    

    // Єдина строчка відсилання нотифікації для усього сайту (Messanger::send($userid, $subject, $message)) 
    public function condence($userid, $message, $subject = NULL)
    {
        $this->_userid = $userid;
        
        $messangerids = array(1,2,3,4,5,6); // ID месенджерів
        
        $this->checkMessanger($messangerids); // Перевіряємо які месенджери є у користувача і на які можна відсидати нотифікацію
        
        if(Yii::app()->params['facebook']) $this->facebook($message);
        
        if(Yii::app()->params['viber']) $this->viber($message);
        
        if(Yii::app()->params['telegram']) $this->telegram($message);
        
        if(Yii::app()->params['whatsapp']) $this->whatsapp($message);
        
        if(Yii::app()->params['twitter']) $this->twitter($message);
        
        if(Yii::app()->params['instagram']) $this->instagram($message);
        
        if(Yii::app()->params['email']) $this->email($subject, $message);
        
    }
    
    // Відправляємо мило користувачу
    protected function email($subject,$message)
    {
       if($subject === NULL) $subject = "Message from UkrYama";
      mail($this->_email->uin,$subject,$message); 
      
    }
    
    
    // Відправляємо повідомлення користувачу в Фейсбук
    protected function facebook($message = NULL)
    {
    
        if($this->_facebook) {          

            //Логіка відправки повідомлення на ФБ користувача ($this->_facebook->uin)
           echo 'Працює друзі'.$this->_facebook->messanger0->name;
            
        } else {
           
            return false;
        
    }
    }
    
    // Відправляємо повідомлення користувачу в Телеграм
    
        protected function telegram($message = NULL)
    {
    
        if($this->_telegram) {          

            //Логіка відправки повідомлення на Telegram користувача ($this->_telegram->uin)
           //echo 'Працює друзі'.$this->_telegram->messanger0->name;
            
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
     * Перевіряємо по списку чи вводив користувач свої месенджери та чи активував на них рохсилання
     */
    protected function checkMessanger($messangerids) 
    {

     
     foreach ($messangerids as $m) {
         $ms = Messangers::model()->find("user = :user_id and messanger = :messangerID and status = 1", 
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

    /**
     * Користувацька функця, що обробляє запит на відправку повідомлення
     * Працює в любому місці сайту і викликається ось так:  Messanger::send(ID користувача, "Текст повідомлення", "Тема повідомлення або без теми");
     * @param int $userid
     * @param string $message
     * @param string $subject
     */
    
    public static function send($userid, $message, $subject = NULL)
    {
    	$mod = new Messanger;
    	$mod->condence($userid, $message, $subject);
    
    }
    
    
    //------------------------------------------------------------------//
    // Функція для тесту
    //------------------------------------------------------------------//
public function test($userid,$messengerID)
{
    $ms = Messangers::model()->find("user = :user_id and messanger = :messangerID", 
                                       array('user_id'=> $userid, 'messangerID'=>$messengerID));
//echo $ms->messanger0->name;
    $this->_messengercalss = $ms;
return $this->_messengercalss;
}



}