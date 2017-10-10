<?php

namespace stesi\billing\models;

use stesi\core\behaviors\UploadImageBehavior;
use nhkey\arh\ActiveRecordHistoryBehavior;
use Yii;
use \stesi\billing\models\base\Invoice as BaseInvoice;
use yii\base\ErrorException;

/**
 * This is the model class for table "inv_invoice".
 *
 * @property \stesi\billing\models\InvoiceRow[] $invoiceRows
 */
class Invoice extends BaseInvoice
{

    public $autoRelationMethodNameEnabled = ['getInvoiceRows'];

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
            'id' => Yii::t('billing/invoice/labels', 'invoice_labels.id'),
            'organization_from_id' => Yii::t('billing/invoice/labels', 'invoice_labels.organization_from_id'),
            'organization_to_id' => Yii::t('billing/invoice/labels', 'invoice_labels.organization_to_id'),
            'status' => Yii::t('billing/invoice/labels', 'invoice_labels.status'),
            'invoice_type' => Yii::t('billing/invoice/labels', 'invoice_labels.invoice_type'),
            'preamble' => Yii::t('billing/invoice/labels', 'invoice_labels.preamble'),
            'number' => Yii::t('billing/invoice/labels', 'invoice_labels.number'),
            'object' => Yii::t('billing/invoice/labels', 'invoice_labels.object'),
            'year' => Yii::t('billing/invoice/labels', 'invoice_labels.year'),
            'invoice_date' => Yii::t('billing/invoice/labels', 'invoice_labels.invoice_date'),
            'competence_date' => Yii::t('billing/invoice/labels', 'invoice_labels.competence_date'),
            'payment_terms_id' => Yii::t('billing/invoice/labels', 'invoice_labels.payment_terms_id'),
            'note' => Yii::t('billing/invoice/labels', 'invoice_labels.note'),
            'taxable' => Yii::t('billing/invoice/labels', 'invoice_labels.taxable'),
            'discount' => Yii::t('billing/invoice/labels', 'invoice_labels.discount'),
            'subtotal' => Yii::t('billing/invoice/labels', 'invoice_labels.subtotal'),
            'tax' => Yii::t('billing/invoice/labels', 'invoice_labels.tax'),
            'total' => Yii::t('billing/invoice/labels', 'invoice_labels.total'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('billing/invoice/hints', 'invoice_hints.id'),
            'organization_from_id' => Yii::t('billing/invoice/hints', 'invoice_hints.organization_from_id'),
            'organization_to_id' => Yii::t('billing/invoice/hints', 'invoice_hints.organization_to_id'),
            'status' => Yii::t('billing/invoice/hints', 'invoice_hints.status'),
            'invoice_type' => Yii::t('billing/invoice/hints', 'invoice_hints.invoice_type'),
            'preamble' => Yii::t('billing/invoice/hints', 'invoice_hints.preamble'),
            'number' => Yii::t('billing/invoice/hints', 'invoice_hints.number'),
            'object' => Yii::t('billing/invoice/hints', 'invoice_hints.object'),
            'year' => Yii::t('billing/invoice/hints', 'invoice_hints.year'),
            'invoice_date' => Yii::t('billing/invoice/hints', 'invoice_hints.invoice_date'),
            'competence_date' => Yii::t('billing/invoice/hints', 'invoice_hints.competence_date'),
            'payment_terms_id' => Yii::t('billing/invoice/hints', 'invoice_hints.payment_terms_id'),
            'note' => Yii::t('billing/invoice/hints', 'invoice_hints.note'),
            'taxable' => Yii::t('billing/invoice/hints', 'invoice_hints.taxable'),
            'discount' => Yii::t('billing/invoice/hints', 'invoice_hints.discount'),
            'subtotal' => Yii::t('billing/invoice/hints', 'invoice_hints.subtotal'),
            'tax' => Yii::t('billing/invoice/hints', 'invoice_hints.tax'),
            'total' => Yii::t('billing/invoice/hints', 'invoice_hints.total'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceRows()
    {
        return $this->hasMany(\stesi\billing\models\InvoiceRow::className(), ['invoice_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        $this->organization_from_id = (new Organization())::find()->andWhere(["=", "owner", 1])->one()->id;
        $this->updateCount();
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function updateCount()
    {
        $this->taxable = $this->countTotalTaxable();
        $this->discount = $this->countTotalDiscount();
        $this->subtotal = $this->countSubTotal();
        $this->tax = $this->countTotalTax();
        $this->total = $this->countTotal();
    }

    public function getPhoneOrganizationFrom()
    {
        $phone = "";
        if (isset($this->organizationFrom)) {
            try {
                $phone = $this->organizationFrom->getOrganizationPhones()->andWhere(['=', "type", "OFFICE"])->one()->phone;
            } catch (\Exception $e) {
                $phone = "";
            }
        }
        return $phone;
    }


    public function getPhoneOrganizationTo()
    {
        $phone = "";
        if (isset($this->organizationTo)) {
            try {
                $phone = $this->organizationTo->getOrganizationPhones()->andWhere(['=', "type", "OFFICE"])->one()->phone;
            } catch (\Exception $e) {
                $phone = "";
            }
        }
        return $phone;
    }

    public function getReferentOrganizationTo()
    {
        $fullName = "";
        if (isset($this->organizationTo)) {
            try {
                $fullName = $this->organizationTo->getOrganization2contacts()->andWhere(["=", "is_referent", 1])->one()->contact->getFullName();
            } catch (\Exception $e) {
                $fullName = "";
            }
        }
        return $fullName;
    }

    public function countTotalTaxable()
    {
        //totale imponibile
        $rows = $this->invoiceRows;
        $tot_taxable = 0;
        foreach ($rows as $row) {
            $tot_taxable += $row->taxable;
        }
        return $tot_taxable;
    }

    public function countTotalDiscount()
    {
        //totale sconto
        $rows = $this->invoiceRows;
        $tot_discount = 0;
        foreach ($rows as $row) {
            $tot_discount += ($row->taxable * $row->discount / 100);
        }
        return $tot_discount;
    }

    public function countSubTotal()
    {
        //totale ivato
        $rows = $this->invoiceRows;
        $subtot = 0;
        foreach ($rows as $row) {
            $subtot += $row->subtotal_row;
        }
        return $subtot;
    }

    public function countTotalTax()
    {
        //totale iva
        $rows = $this->invoiceRows;
        $tot_tax = 0;
        foreach ($rows as $row) {
            $tot_tax += $row->tax;
        }
        return $tot_tax;
    }

    public function countTotal()
    {
        //totale scontato
        $rows = $this->invoiceRows;
        $total = 0;
        foreach ($rows as $row) {
            $total += $row->total_row;
        }
        return $total;
    }


}
