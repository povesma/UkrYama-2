<?php
class Y
{

   public static function declOfNum($number, $titles, $translate = false)
   {
      $cases = array (2, 0, 1, 1, 1, 2);
      $number=abs($number);
      $index = ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)];
      $suffix = $translate ? Yii::t('holes', $titles[$index]) : $titles[$index];
      return trim($number . "&nbsp;" . $suffix, '&nbsp;');
   }

   public static function declOfDays($count, $digits = true){
      $days = Yii::t('template', 'COUNT_DAYS');
      if ($digits)
         return self::declOfNum($count, $days);
      else
         return trim(preg_replace('/[\d]/', '', self::declOfNum($count, $days)),'&nbsp;');      
   }

    public function declOfNumArr($number, $titles, $translate = false)
    {
        $cases = array (2, 0, 1, 1, 1, 2);
        $number=abs($number);
        $index = ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)];
        $suffix = $translate ? Yii::t('holes', $titles[$index]) : $titles[$index];
        return Array($number, $suffix);
    }
		
	public static function dateFromTime($time)
	{
 		return Yii::app()->dateFormatter->formatDateTime($time, 'long', false);
	}
   
	public static function dateTimeFromTime($time)
	{
 		return Yii::app()->dateFormatter->formatDateTime($time, 'long');
	}   
   
	public static function dateFromTimeShort($time)
		{
    		return Yii::app()->dateFormatter->formatDateTime($time,'short','short');
		}		
	
}
?>