<?php

namespace stesi\invoice\models\base;
use stesi\core\models\base\StesiModel;

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
 * @property string $year
 * @property string $invoice_date
 * @property string $competence_date
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $payment_terms_id
 * @property string $note
 * @property double $subtotal
 * @property double $tax
 * @property double $total
 *
 * @property \stesi\invoice\models\Organization $organizationFrom
 * @property \stesi\invoice\models\Organization $organizationTo
 * @property \stesi\invoice\models\PaymentTerms $paymentTerms
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
            [['subtotal', 'tax', 'total'], 'number'],
            [['preamble'], 'string', 'max' => 20],
            [['preamble'], 'default'],
            [['organization_from_id'], 'exist', 'skipOnError' => true, 'targetClass' => \stesi\invoice\models\Organization::className(), 'targetAttribute' => ['organization_from_id' => 'id']],
            [['organization_to_id'], 'exist', 'skipOnError' => true, 'targetClass' => \stesi\invoice\models\Organization::className(), 'targetAttribute' => ['organization_to_id' => 'id']],
            [['payment_terms_id'], 'exist', 'skipOnError' => true, 'targetClass' => \stesi\invoice\models\PaymentTerms::className(), 'targetAttribute' => ['payment_terms_id' => 'id']]
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
        return $this->hasOne(\stesi\invoice\models\Organization::className(), ['id' => 'organization_from_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationTo()
    {
        return $this->hasOne(\stesi\invoice\models\Organization::className(), ['id' => 'organization_to_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentTerms()
    {
        return $this->hasOne(\stesi\invoice\models\PaymentTerms::className(), ['id' => 'payment_terms_id']);
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
     * @return \stesi\invoice\models\InvoiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \stesi\invoice\models\InvoiceQuery(get_called_class());
    }
    
}

