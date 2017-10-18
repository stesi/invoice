<?php

namespace stesi\billing\models\base;

use stesi\billing\models\Organization;
use stesi\billing\models\Invoice;
use stesi\core\models\base\StesiModel;

use Yii;

/**
 * This is the base model class for table "inv_invoice_organization_info".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $organization_id
 * @property string $name
 * @property string $logo
 * @property string $vat_number
 * @property string $bank
 * @property string $iban
 * @property string $swift
 * @property string $address
 * @property string $city
 * @property integer $pc
 * @property string $phone
 * @property string $fax
 * @property string $email
 *
 * @property \stesi\billing\models\Invoice $invoice
 * @property \stesi\billing\models\Organization $organization
 */
class InvoiceOrganizationInfo extends StesiModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'organization_id', 'pc'], 'integer'],
            [['name', 'bank', 'address'], 'string', 'max' => 128],
            [['name', 'bank', 'address'], 'default'],
            [['logo'], 'string', 'max' => 256],
            [['logo'], 'default'],
            [['vat_number'], 'string', 'max' => 13],
            [['vat_number'], 'default'],
            [['iban'], 'string', 'max' => 27],
            [['iban'], 'default'],
            [['swift'], 'string', 'max' => 11],
            [['swift'], 'default'],
            [['city', 'phone', 'fax'], 'string', 'max' => 20],
            [['city', 'phone', 'fax'], 'default'],
            [['email'], 'string', 'max' => 64],
            [['email'], 'default'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inv_invoice_organization_info';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }


}
