<?php

namespace stesi\invoice\models;
use Yii;
use \stesi\invoice\models\base\Invoice as BaseInvoice;

/**
 * This is the model class for table "inv_invoice".
 *
 * @property \stesi\invoice\models\InvoiceRow[] $invoiceRows
 */
class Invoice extends BaseInvoice
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
        'id' => Yii::t('invoice/invoice/labels', 'invoice_labels.id'),
        'organization_from_id' => Yii::t('invoice/invoice/labels', 'invoice_labels.organization_from_id'),
        'organization_to_id' => Yii::t('invoice/invoice/labels', 'invoice_labels.organization_to_id'),
        'status' => Yii::t('invoice/invoice/labels', 'invoice_labels.status'),
        'invoice_type' => Yii::t('invoice/invoice/labels', 'invoice_labels.invoice_type'),
        'preamble' => Yii::t('invoice/invoice/labels', 'invoice_labels.preamble'),
        'number' => Yii::t('invoice/invoice/labels', 'invoice_labels.number'),
        'year' => Yii::t('invoice/invoice/labels', 'invoice_labels.year'),
        'invoice_date' => Yii::t('invoice/invoice/labels', 'invoice_labels.invoice_date'),
        'competence_date' => Yii::t('invoice/invoice/labels', 'invoice_labels.competence_date'),
        'payment_terms_id' => Yii::t('invoice/invoice/labels', 'invoice_labels.payment_terms_id'),
        'note' => Yii::t('invoice/invoice/labels', 'invoice_labels.note'),
        'subtotal' => Yii::t('invoice/invoice/labels', 'invoice_labels.subtotal'),
        'tax' => Yii::t('invoice/invoice/labels', 'invoice_labels.tax'),
        'total' => Yii::t('invoice/invoice/labels', 'invoice_labels.total'),
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('invoice/invoice/hints', 'invoice_hints.id'),
            'organization_from_id' => Yii::t('invoice/invoice/hints', 'invoice_hints.organization_from_id'),
            'organization_to_id' => Yii::t('invoice/invoice/hints', 'invoice_hints.organization_to_id'),
            'status' => Yii::t('invoice/invoice/hints', 'invoice_hints.status'),
            'invoice_type' => Yii::t('invoice/invoice/hints', 'invoice_hints.invoice_type'),
            'preamble' => Yii::t('invoice/invoice/hints', 'invoice_hints.preamble'),
            'number' => Yii::t('invoice/invoice/hints', 'invoice_hints.number'),
            'year' => Yii::t('invoice/invoice/hints', 'invoice_hints.year'),
            'invoice_date' => Yii::t('invoice/invoice/hints', 'invoice_hints.invoice_date'),
            'competence_date' => Yii::t('invoice/invoice/hints', 'invoice_hints.competence_date'),
            'payment_terms_id' => Yii::t('invoice/invoice/hints', 'invoice_hints.payment_terms_id'),
            'note' => Yii::t('invoice/invoice/hints', 'invoice_hints.note'),
            'subtotal' => Yii::t('invoice/invoice/hints', 'invoice_hints.subtotal'),
            'tax' => Yii::t('invoice/invoice/hints', 'invoice_hints.tax'),
            'total' => Yii::t('invoice/invoice/hints', 'invoice_hints.total'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceRows()
    {
        return $this->hasMany(\stesi\invoice\models\InvoiceRow::className(), ['invoice_id' => 'id']);
    }
}
