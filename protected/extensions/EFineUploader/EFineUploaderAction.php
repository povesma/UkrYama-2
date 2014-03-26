<?php

class EFineUploaderAction extends CAction
{

        public function run()
        {
                $tempFolder=Yii::getPathOfAlias('webroot').'/upload/video/';

                @mkdir($tempFolder, 0777, TRUE);
                @mkdir($tempFolder.'chunks', 0777, TRUE);

                Yii::import("ext.EFineUploader.qqFileUploader");

                $uploader = new qqFileUploader();
                $uploader->allowedExtensions = array('mp4','flv');
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
}
