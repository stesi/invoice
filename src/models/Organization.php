<?php

namespace stesi\invoice\models;

use \stesi\gles\models\Organization as GlesOrganization;
use app\services\StesiTools;
use kartik\helpers\Html;

use nhkey\arh\ActiveRecordHistoryBehavior;
use app\services\UploadImageBehavior;
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
