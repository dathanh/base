<?php

namespace Backend\Base;

use Backend\Utility\Utils;
use Cake\Core\Configure;

trait BaseService {

    protected function processUploadFile($field, $entity, $dir) {
        $desPath = Configure::read('Upload.UploadFolder');
        $fileDir = $desPath . $dir;
        Utils::useComponents($this, ['Backend.AdminCommon']);
        $fileName = $this->AdminCommon->uploadFile($this->request->getData($field . '_upload'), $fileDir);

        $originalImage = $entity->$field;
        if ((!empty($_FILES[$field . '_upload']['name']) && !empty($fileName)) || (empty($fileName) && !empty($entity->$field))) {
            if (!empty($fileName)) {
                $entity->$field = $fileName;
                $linkFile = 'link' . Inflector::camelize($field);
                $entity->$linkFile = Configure::read('LinkStatic.UploadFolder') . $dir . $fileName;

                if (!empty($originalImage) && $originalImage != $entity->$field) {
                    $originalImage = str_replace($fileDir, $desPath, $originalImage);
                    @unlink($originalImage);
                }
            }
        }
    }

    public function uploadMultiFile() {
        if (!$this->request->is('ajax')) {
            return $this->redirect(['action' => 'index']);
        }
        Utils::useComponents($this, ['Backend.AdminCommon']);
        $data = $this->request->getData(['file']);

        if (!empty($data)) {
            if ($this->AdminCommon->isValidImage($data)) {
                //Upload image and create image thumbnail
                $desPath = Configure::read('Upload.UploadFolder');
                $fileDir = $desPath . $this->tableName . '/Gallery/';
                $data = $this->AdminCommon->uploadImage($data, $fileDir);
                $this->actionSuccess($data);
            } else {
                $this->actionNotFound("Can't upload image");
            }
        }
    }

    public function removeMultiFile() {
        if (!$this->request->is('ajax')) {
            return $this->redirect(['action' => 'index']);
        }
        $fileDir = IMAGE_GALLERY_DIR . $this->request->getData(['fileRemove']);
        $savedFileDir = IMAGE_GALLERY_DIR . $this->request->getData(['fileNameDefault']);
        if (!is_dir($fileDir)) {
//            @unlink($fileDir);
            $this->actionSuccess('success');
        } else {
            if (!is_dir($savedFileDir)) {
//                @unlink($savedFileDir);
                $this->actionSuccess('success');
            } else {
                $this->actionNotFound("File doesn't exist");
            }
        }
    }

}
