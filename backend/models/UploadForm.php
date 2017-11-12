<?php
/**
 * Created by PhpStorm.
 * User: suwen
 * Date: 2017/11/12
 * Time: 09:50
 */

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $credFile;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['credFile'], 'file'],
        ];
    }
}