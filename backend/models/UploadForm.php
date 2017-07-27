<?php
	namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }
    
    public function upload($folder1,$folder2)
    {
        if(!is_dir('../uploads/'.$folder2.')'.$folder1))
        	mkdir('../uploads/'.$folder2.')'.$folder1);
            foreach ($this->imageFiles as $file) {
                $file->saveAs('../uploads/'.$folder2.')'.$folder1.'/' . $file->baseName . '.' . $file->extension);
            }
            return true;
    }
}
?>