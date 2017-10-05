<?php

namespace stesi\invoice\models;
use Yii;
use \stesi\invoice\models\base\InvoiceRow as BaseInvoiceRow;

/**
 * This is the model class for table "inv_invoice_row".
 */
class InvoiceRow extends BaseInvoiceRow
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
        'id' => Yii::t('invoice/invoice_row/labels', 'invoice_row_labels.id'),
        'invoice_id' => Yii::t('invoice/invoice_row/labels', 'invoice_row_labels.invoice_id'),
        'product_id' => Yii::t('invoice/invoice_row/labels', 'invoice_row_labels.product_id'),
        'quantity' => Yii::t('invoice/invoice_row/labels', 'invoice_row_labels.quantity'),
        'measurement_unit' => Yii::t('invoice/invoice_row/labels', 'invoice_row_labels.measurement_unit'),
        'unit_price' => Yii::t('invoice/invoice_row/labels', 'invoice_row_labels.unit_price'),
        'vat_id' => Yii::t('invoice/invoice_row/labels', 'invoice_row_labels.vat_id'),
        'tax' => Yii::t('invoice/invoice_row/labels', 'invoice_row_labels.tax'),
        'total_row' => Yii::t('invoice/invoice_row/labels', 'invoice_row_labels.total_row'),
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('invoice/invoice_row/hints', 'invoice_row_hints.id'),
            'invoice_id' => Yii::t('invoice/invoice_row/hints', 'invoice_row_hints.invoice_id'),
            'product_id' => Yii::t('invoice/invoice_row/hints', 'invoice_row_hints.product_id'),
            'quantity' => Yii::t('invoice/invoice_row/hints', 'invoice_row_hints.quantity'),
            'measurement_unit' => Yii::t('invoice/invoice_row/hints', 'invoice_row_hints.measurement_unit'),
            'unit_price' => Yii::t('invoice/invoice_row/hints', 'invoice_row_hints.unit_price'),
            'vat_id' => Yii::t('invoice/invoice_row/hints', 'invoice_row_hints.vat_id'),
            'tax' => Yii::t('invoice/invoice_row/hints', 'invoice_row_hints.tax'),
            'total_row' => Yii::t('invoice/invoice_row/hints', 'invoice_row_hints.total_row'),
        ];
    }
}
