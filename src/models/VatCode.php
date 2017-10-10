<?php

namespace stesi\billing\models;

use Yii;
use \stesi\billing\models\base\VatCode as BaseVatCode;

/**
 * This is the model class for table "inv_vat_code".
 */
class VatCode extends BaseVatCode
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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('billing/vat_code/labels', 'vat_code_labels.id'),
            'code' => Yii::t('billing/vat_code/labels', 'vat_code_labels.code'),
            'vat' => Yii::t('billing/vat_code/labels', 'vat_code_labels.vat'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('billing/vat_code/hints', 'vat_code_hints.id'),
            'code' => Yii::t('billing/vat_code/hints', 'vat_code_hints.code'),
            'vat' => Yii::t('billing/vat_code/hints', 'vat_code_hints.vat'),
        ];
    }

}
