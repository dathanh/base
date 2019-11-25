<?php

namespace Backend\Controller\Component;

use Cake\Controller\Component;
use Backend\Utility\Utils;

class AdminCommonComponent extends Component {

    public function getAllIPWhiteList() {
        Utils::useTables($this, ['Backend.AdminWhitelistIps']);

        $result = $this->AdminWhitelistIps->find('all', [
            'fields' => [
                'AdminWhitelistIps.ip'
            ]
        ]);

        if (!empty($result)) {
            return $result->toArray();
        }
        return [];
    }

    public function uploadFile($file, $dir = FILE_DIR, $size = NULL) {
        $allow_ext = []; // allow all
        if ($this->isValidFile($file, $allow_ext)) {
            $now = getdate();
            $str_rand = $now["hours"] . $now["minutes"] . $now["seconds"];


            // Check folder
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
                chmod($dir, 0777);
            }
            $fileName = null;
            if (!empty($file['tmp_name']) && is_uploaded_file($file['tmp_name'])) {
                // trim and truncate whitespace
                $originalName = $this->_cleanupFilename(basename($file['name']));

                // Strip path information
                $fileName = $str_rand . '_' . $originalName;
                move_uploaded_file(
                        $file['tmp_name'], $dir . $fileName
                );
                return $fileName;
            }
        }
        return false;
    }

    public function isValidFile($file, $ext_allow = []) {
        if (empty($file) || empty($file['name'])) {
            return false;
        }

        // Allow all file
        if (empty($ext_allow)) {
            return true;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (is_array($ext_allow) && in_array($ext, $ext_allow)) {
            return true;
        }
        return false;
    }

    public function isValidImage($image) {
        $ext_allow = explode(',', IMAGE_EXT);
        return $this->isValidFile($image, $ext_allow);
    }

    public function uploadImage($image, $dir, $thumbDir = IMAGE_THUMBNAIL_DIR, $size = NULL) {

        if (isset($image) && !empty($image) && (isset($image['name']) && !empty($image['name']))
        ) {
            $now = getdate();
            $str_rand = $now["hours"] . $now["minutes"] . $now["seconds"];

            if ($this->request->getParam('controller') == 'AdminUsers' ||
                    $this->request->getParam('controller') == 'Users'
            ) {
                self::createImageThumbnail($image, IMAGE_THUMBNAIL_DIR, $str_rand, IMAGE_THUMBNAIL_MAX_WIDTH, IMAGE_THUMBNAIL_MAX_HEIGHT);
            }


            // Check folder
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
                chmod($dir, 0777);
            }
            $fileName = null;
            if (
                    !empty($image['tmp_name']) && is_uploaded_file($image['tmp_name'])
            ) {
                // trim and truncate whitespace
                $originalName = $this->_cleanupFilename(basename($image['name']));
                // Strip path information
                $fileName = $str_rand . uniqid() . '_' . $originalName;
                ;
                move_uploaded_file(
                        $image['tmp_name'], $dir . $fileName
                );
                return $fileName;
            }
        }
        return false;
    }

    protected function _cleanupFilename($filename) {
        $originalName = trim(addslashes($filename));
        $originalName = preg_replace('/\s+/', '_', $originalName);

        return $originalName;
    }

    public function createImageThumbnail($image, $dir = IMAGE_THUMBNAIL_DIR, $h = '', $maxWidth = IMAGE_THUMBNAIL_MAX_WIDTH, $maxHeight = IMAGE_THUMBNAIL_MAX_HEIGHT) {

        $originalFilename = $this->_cleanupFilename($image['name']);
        $imageName = (!empty($h) ? ($h . '_') : '') . $originalFilename;

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
            chmod($dir, 0777);
        }

        if ((!empty($image['tmp_name']) && is_uploaded_file($image['tmp_name'])) || (!empty($image['img']))) {
            $tempImage = !empty($image['tmp_name']) ? $image['tmp_name'] : $image['img'];
            list($imageWidth, $imageHeight, $imageType) = getimagesize($tempImage);

            $imageType = ($imageType == 1 ? "gif" :
                    ($imageType == 2 ? "jpeg" :
                    ($imageType == 3 ? "png" : false)));

            if ($imageType) {
                $CreateFunction = "imagecreatefrom" . $imageType;
                $OutputFunction = "image" . $imageType;

                $ratio = ($imageHeight / $imageWidth);
                $ImageSource = $CreateFunction($tempImage);

                if ($imageWidth > $maxWidth || $imageHeight > $maxHeight) {
                    if ($imageWidth > $maxWidth) {
                        $newWidth = $maxWidth;
                        $newHeight = $newWidth * $ratio;
                    } else {
                        $newWidth = $imageWidth;
                        $newHeight = $imageHeight;
                    }

                    if ($newHeight > $maxHeight) {
                        $newHeight = $maxHeight;
                        $newWidth = $newHeight / $ratio;
                    }

                    $newImage = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresampled($newImage, $ImageSource, 0, 0, 0, 0, $newWidth, $newHeight, $imageWidth, $imageHeight);
                } else {
                    $newImage = $ImageSource;
                }
                if ($imageType == 'png') {
                    $OutputFunction($newImage, $dir . $imageName, 9);
                } else {
                    $OutputFunction($newImage, $dir . $imageName, 100);
                }
                imagedestroy($ImageSource);
                return $imageName;
            }
        }
        return false;
    }

}
