<?php

namespace stesi\invoice\models\base;
use stesi\core\models\base\StesiModel;

use Yii;

/**
 * This is the base model class for table "inv_vat_code".
 *
 * @property integer $id
 * @property string $code
 */
class VatCode extends StesiModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'string', 'max' => 32],
            [['code'], 'default']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inv_vat_code';
    }

}

