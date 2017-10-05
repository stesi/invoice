<?php

namespace stesi\invoice\models\base;
use stesi\core\models\base\StesiModel;

use Yii;

/**
 * This is the base model class for table "inv_invoice_row".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $product_id
 * @property double $quantity
 * @property string $measurement_unit
 * @property double $unit_price
 * @property integer $vat_id
 * @property double $tax
 * @property double $total_row
 *
 * @property \stesi\invoice\models\Invoice $invoice
 * @property \stesi\invoice\models\Product $product
 * @property \stesi\invoice\models\VatCode $vat
 */
class InvoiceRow extends StesiModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'product_id', 'vat_id'], 'integer'],
            [['quantity', 'unit_price', 'tax', 'total_row'], 'number'],
            [['measurement_unit'], 'string', 'max' => 20],
            [['measurement_unit'], 'default'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => \stesi\invoice\models\Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => \stesi\invoice\models\Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['vat_id'], 'exist', 'skipOnError' => true, 'targetClass' => \stesi\invoice\models\VatCode::className(), 'targetAttribute' => ['vat_id' => 'id']]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inv_invoice_row';
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(\stesi\invoice\models\Invoice::className(), ['id' => 'invoice_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(\stesi\invoice\models\Product::className(), ['id' => 'product_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVat()
    {
        return $this->hasOne(\stesi\invoice\models\VatCode::className(), ['id' => 'vat_id']);
    }
    
}

