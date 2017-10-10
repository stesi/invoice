<?php

namespace stesi\core\models\base\StesiModel\models\base;
use stesi\core\models\base\StesiModel;

use stesi\core\models\base\StesiModel\models\Organization;
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
 * @property string $invoice_type
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
 * @property integer $payment_terms_id
 * @property string $note
 * @property double $taxable
 * @property double $discount
 * @property double $subtotal
 * @property double $tax
 * @property double $total
 *
 * @property \stesi\core\models\base\StesiModel\models\Organization $organizationFrom
 * @property \stesi\core\models\base\StesiModel\models\Organization $organizationTo
 * @property \stesi\core\models\base\StesiModel\models\PaymentTerms $paymentTerms
 */
class Invoice extends StesiModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organization_from_id', 'organization_to_id', 'number', 'created_by', 'updated_by', 'payment_terms_id'], 'integer'],
            [['status', 'invoice_type', 'note'], 'string'],
            [['year', 'invoice_date', 'competence_date', 'created_at', 'updated_at'], 'safe'],
            [['taxable', 'discount', 'subtotal', 'tax', 'total'], 'number'],
            [['preamble'], 'string', 'max' => 20],
            [['preamble'], 'default'],
            [['object'], 'string', 'max' => 120],
            [['object'], 'default'],
            [['organization_from_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_from_id' => 'id']],
            [['organization_to_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_to_id' => 'id']],
            [['payment_terms_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentTerms::className(), 'targetAttribute' => ['payment_terms_id' => 'id']]
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
        return $this->hasOne(\stesi\core\models\base\StesiModel\models\Organization::className(), ['id' => 'organization_from_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationTo()
    {
        return $this->hasOne(\stesi\core\models\base\StesiModel\models\Organization::className(), ['id' => 'organization_to_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentTerms()
    {
        return $this->hasOne(\stesi\core\models\base\StesiModel\models\PaymentTerms::className(), ['id' => 'payment_terms_id']);
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
     * @return \stesi\core\models\base\StesiModel\models\InvoiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \stesi\core\models\base\StesiModel\models\InvoiceQuery(get_called_class());
    }
    
}

