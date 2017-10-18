<?php

namespace stesi\billing\models;
use Yii;
use \stesi\billing\models\base\InvoiceOrganizationInfo as BaseInvInvoiceOrganizationInfo;

/**
 * This is the model class for table "inv_invoice_organization_info".
 */
class InvoiceOrganizationInfo extends BaseInvInvoiceOrganizationInfo
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
            'id' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.id'),
            'invoice_id' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.invoice_id'),
            'organization_id' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.organization_id'),
            'name' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.name'),
            'logo' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.logo'),
            'vat_number' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.vat_number'),
            'bank' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.bank'),
            'iban' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.iban'),
            'swift' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.swift'),
            'address' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.address'),
            'city' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.city'),
            'pc' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.pc'),
            'phone' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.phone'),
            'fax' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.fax'),
            'email' => Yii::t('billing/invoice_organization_info/labels', 'invoice_organization_info_labels.email'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.id'),
            'invoice_id' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.invoice_id'),
            'organization_id' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.organization_id'),
            'name' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.name'),
            'logo' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.logo'),
            'vat_number' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.vat_number'),
            'bank' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.bank'),
            'iban' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.iban'),
            'swift' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.swift'),
            'address' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.address'),
            'city' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.city'),
            'pc' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.pc'),
            'phone' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.phone'),
            'fax' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.fax'),
            'email' => Yii::t('billing/invoice_organization_info/hints', 'invoice_organization_info_hints.email'),
        ];
    }
}