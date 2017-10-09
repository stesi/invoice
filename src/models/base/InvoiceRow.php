<?php

namespace stesi\invoice\models\base;
use stesi\core\models\base\StesiModel;

use stesi\invoice\models\Product;
use Yii;

/**
 * This is the base model class for table "inv_invoice_row".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $product_id
 * @property string $description
 * @property double $quantity
 * @property string $measurement_unit
 * @property double $unit_price
 * @property integer $vat_id
 * @property double $vat_value
 * @property double $taxable
 * @property double $discount
 * @property double $subtotal_row
 * @property double $tax
 * @property double $total_row
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
            [['product_id'], 'required'],
            [['description'], 'string'],
            [['quantity', 'unit_price', 'vat_value', 'taxable', 'discount', 'subtotal_row', 'tax', 'total_row'], 'number'],
            [['measurement_unit'], 'string', 'max' => 20],
            [['measurement_unit'], 'default'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['vat_id'], 'exist', 'skipOnError' => true, 'targetClass' => VatCode::className(), 'targetAttribute' => ['vat_id' => 'id']]
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

    /**
     * @return \stesi\invoice\models\InvoiceRowQuery
     */
    public static function find()
    {
        return new \stesi\invoice\models\InvoiceRowQuery(get_called_class());
    }
    
}

