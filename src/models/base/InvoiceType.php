<?php

namespace stesi\billing\models\base;
use stesi\core\models\base\StesiModel;

use stesi\billing\models\Organization;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "inv_invoice_type".
 *
 * @property integer $id
 * @property string $code
 * @property string $type
 *
 */
class InvoiceType extends StesiModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['code', 'invoice_type'], 'string'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inv_invoice_type';
    }

    
}

