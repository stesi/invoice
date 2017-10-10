<?php

namespace stesi\core\models\base\StesiModel\models\base;
use stesi\core\models\base\StesiModel;

use Yii;

/**
 * This is the base model class for table "inv_payment_terms".
 *
 * @property integer $id
 * @property string $name
 */
class PaymentTerms extends StesiModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 32],
            [['name'], 'default']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inv_payment_terms';
    }

}

