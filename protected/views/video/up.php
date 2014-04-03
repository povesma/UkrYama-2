<?php
$this->widget('ext.EFineUploader.EFineUploader',
 array(
       'id'=>'FineUploader',
       'config'=>array(
                       'autoUpload'=>true,
                       'request'=>array(
                          'endpoint'=>'/video/upload',// OR $this->createUrl('files/upload'),
                          'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                                       ),
                       'retry'=>array('enableAuto'=>true,'preventRetryResponseProperty'=>true),
                       'chunking'=>array('enable'=>true,'partSize'=>100),//bytes
                       'callbacks'=>array(
                                        'onComplete'=>"js:function(id, name, response){  }",
                                        'onError'=>"js:function(id, name, errorReason){ }",
                                         ),
                       'validation'=>array(
                                 'allowedExtensions'=>array('mp4','flv', 'ogv', 'jpg', 'png', 'jpeg'),
                                 'sizeLimit'=>157286400,//maximum file size in bytes
                                 'minSizeLimit'=>1024,// minimum file size in bytes
                                          ),
                      )
      ));
 
?>
