EFineUploader - Данное расширение для Yii Framework позволяет загружать файлы без использования Flash
=======

## Установка

* Скачать ([zip](https://github.com/kosenka/EFineUploader/zipball/master), [tar.gz](https://github.com/kosenka/EFineUploader/tarball/master)).

* Распаковать архив в папку `application.extensions.EFineUploader` . Должно получиться следующее:

```
protected/
├── components/
├── controllers/
├── ... application directories
└── extensions/
    ├── EFineUploader/
    │   ├── assets/
    │   └── ... другие файлы расширения EFineUploader
    └── ... другие расширения
```

## ССылки

* [Demo](http://kosenka.ru/#tab1)
* [Extension project page](https://github.com/kosenka/EFineUploader)
* [Russian community discussion thread](http://yiiframework.ru/forum/viewtopic.php?f=9&t=2470)

## Использование
В представлении/шаблоне прописать так:

```php
<? $this->widget('ext.EFineUploader.EFineUploader',
                 array(
                       'id'=>'FineUploader',
                       'config'=>array(
                                       'autoUpload'=>true,
                                       'request'=>array(
                                                        'endpoint'=>'/controller/upload',// OR $this->createUrl('controller/upload'),
                                                        'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                                                       ),
                                       'retry'=>array('enableAuto'=>true,'preventRetryResponseProperty'=>true),
                                       'chunking'=>array('enable'=>true,'partSize'=>100),//bytes
                                       'callbacks'=>array(
                                                          'onComplete'=>"js:function(id, name, response){ $('li.qq-upload-success').remove(); }",
                                                          //'onError'=>"js:function(id, name, errorReason){ }",
                                                         ),
                                       'validation'=>array(
                                                           'allowedExtensions'=>array('jpg','jpeg'),
                                                           'sizeLimit'=>2 * 1024 * 1024,//maximum file size in bytes
                                                           //'minSizeLimit'=>2*1024*1024,// minimum file size in bytes
                                                          ),
                                       /*'messages'=>array(
                                                         'tooManyItemsError'=>'Too many items error',
                                                         'typeError'=>"Файл {file} имеет неверное расширение. Разрешены файлы только с расширениями: {extensions}.",
                                                         'sizeError'=>"Размер файла {file} велик, максимальный размер {sizeLimit}.",
                                                         'minSizeError'=>"Размер файла {file} мал, минимальный размер {minSizeLimit}.",
                                                         'emptyError'=>"{file} is empty, please select files again without it.",
                                                         'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                                        ),*/
                                      )
                      ));
                ?>
```

В контроллере:
```php
<?
        public function actionUpload()
        {
                $tempFolder=Yii::getPathOfAlias('webroot').'/upload/efineuploader/';

                @mkdir($tempFolder, 0777, TRUE);
                @mkdir($tempFolder.'chunks', 0777, TRUE);

                Yii::import("ext.EFineUploader.qqFileUploader");

                $uploader = new qqFileUploader();
                $uploader->allowedExtensions = array('jpg','jpeg');
                $uploader->sizeLimit = 2 * 1024 * 1024;//maximum file size in bytes
                $uploader->chunksFolder = $tempFolder.'chunks';

                $result = $uploader->handleUpload($tempFolder);
                $result['filename'] = $uploader->getUploadName();
                $result['folder'] = $webFolder;

                $uploadedFile=$tempFolder.$result['filename'];

                header("Content-Type: text/plain");
                $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                echo $result;
                Yii::app()->end();
        }
?>
```
