<?php

namespace stesi\billing\models;

use Yii;
use \stesi\billing\models\base\InvoiceType as BaseInvoiceType;


/**
 * This is the model class for table "inv_invoice_type".
 *
 */
class InvoiceType extends BaseInvoiceType
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
            'id' => Yii::t('billing/invoice_type/labels', 'invoice_type_labels.id'),
            'code' => Yii::t('billing/invoice_type/labels', 'invoice_type_labels.code'),
            'type' => Yii::t('billing/invoice_type/labels', 'invoice_type_labels.type'),

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('billing/invoice_type/hints', 'invoice_type_hints.id'),
            'code' => Yii::t('billing/invoice_type/hints', 'invoice_type_hints.code'),
            'type' => Yii::t('billing/invoice_type/hints', 'invoice_type_hints.type'),
        ];
    }




}
