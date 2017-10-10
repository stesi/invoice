<?php

namespace stesi\billing\models;

/**
 * This is the ActiveQuery class for [[InvoiceRow]].
 *
 * @see InvoiceRow
 */
class InvoiceRowQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return Invoice[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Invoice|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}