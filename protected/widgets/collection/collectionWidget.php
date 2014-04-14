<?php

class collectionWidget extends CWidget {
        
   public $itemview='default';
   
   public function init() {
      $this->registerCoreScripts();
      parent::init();
   }

   protected function registerCoreScripts() {
      //$cs=Yii::app()->getClientScript();
      //$cs->registerCoreScript('jquery');
   }

   public function run() {
      $all = Holes::model()->count(array('condition'=>'PREMODERATED=1'));
      $ingibdd = Holes::model()->count(array('condition'=>'PREMODERATED=1 AND STATE="inprogress"'));
      $fixed = Holes::model()->count(array('condition'=>'PREMODERATED=1 AND STATE="fixed"'));
      $this->registerCoreScripts();
      $this->render($this->itemview, Array(
         'all'=>$all,
         'ingibdd'=>$ingibdd,
         'fixed'=>$fixed,
      ));
   }
}
