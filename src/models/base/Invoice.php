<?php

namespace stesi\billing\models\base;
use stesi\core\models\base\StesiModel;

use stesi\billing\models\Organization;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "inv_invoice".
 *
 * @property integer $id
 * @property integer $organization_from_id
 * @property integer $organization_to_id
 * @property string $status
 * @property integer $invoice_type_id
 * @property string $preamble
 * @property integer $number
 * @property string $object
 * @property string $year
 * @property string $invoice_date
 * @property string $competence_date
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $payment_terms
 * @property string $note
 * @property double $taxable
 * @property double $discount
 * @property double $subtotal
 * @property double $tax
 * @property double $total
 *
 * @property \stesi\billing\models\Organization $organizationFrom
 * @property \stesi\billing\models\Organization $organizationTo
 * @property \stesi\billing\models\PaymentTerms $paymentTerms
 * @property \stesi\billing\models\InvoiceType $invoiceType
 */
class Invoice extends StesiModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organization_from_id', 'organization_to_id', 'number', 'invoice_type_id', 'created_by', 'updated_by'], 'integer'],
            [['status', 'note'], 'string'],
            [['invoice_type_id'], 'required'],
            [['year', 'invoice_date', 'competence_date', 'created_at', 'updated_at'], 'safe'],
            [['taxable', 'discount', 'subtotal', 'tax', 'total'], 'number'],
            [['preamble'], 'string', 'max' => 20],
            [['preamble'], 'default'],
            [['object'], 'string', 'max' => 120],
            [['object'], 'default'],
            [['payment_terms'], 'string', 'max' => 32],
            [['payment_terms'], 'default'],
            [['organization_from_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_from_id' => 'id']],
            [['organization_to_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_to_id' => 'id']],
           [['invoice_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvoiceType::className(), 'targetAttribute' => ['invoice_type_id' => 'id']]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inv_invoice';
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationFrom()
    {
        return $this->hasOne(\stesi\billing\models\Organization::className(), ['id' => 'organization_from_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationTo()
    {
        return $this->hasOne(\stesi\billing\models\Organization::className(), ['id' => 'organization_to_id']);
    }
        

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceType()
    {
        return $this->hasOne(\stesi\billing\models\InvoiceType::className(), ['id' => 'invoice_type_id']);
    }


    /**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('current_timestamp'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \stesi\billing\models\InvoiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \stesi\billing\models\InvoiceQuery(get_called_class());
    }
    
}

