<?php

namespace stesi\invoice\models\base;
use app\models\base\StesiModel;

use Yii;

/**
 * This is the base model class for table "inv_vat_code".
 *
 * @property integer $id
 * @property string $code
 * @property double $vat
 */
class VatCode extends StesiModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'string', 'max' => 120],
            [['code'], 'default'],
            [['vat'], 'number'],
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

