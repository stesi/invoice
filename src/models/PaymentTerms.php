<?php

namespace stesi\invoice\models;
use Yii;
use \stesi\invoice\models\base\PaymentTerms as BasePaymentTerms;

/**
 * This is the model class for table "inv_payment_terms".
 */
class PaymentTerms extends BasePaymentTerms
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
        'id' => Yii::t('invoice/payment_terms/labels', 'payment_terms_labels.id'),
        'name' => Yii::t('invoice/payment_terms/labels', 'payment_terms_labels.name'),
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('invoice/payment_terms/hints', 'payment_terms_hints.id'),
            'name' => Yii::t('invoice/payment_terms/hints', 'payment_terms_hints.name'),
        ];
    }
}
