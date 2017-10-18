<?php

namespace stesi\billing\models;

use \stesi\gles\models\Organization as GlesOrganization;
use stesi\core\services\StesiTools;
use kartik\helpers\Html;

use nhkey\arh\ActiveRecordHistoryBehavior;
use stesi\core\behaviors\UploadImageBehavior;
use Yii;



class Organization extends GlesOrganization
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return parent::rules();
        //return array_merge(parent::rules(), []);
        //return array_replace_recursive(parent::rules(),[]);
    }


}
