<?php
/**
 * Created by PhpStorm.
 * User: Sara
 * Date: 06/10/2017
 * Time: 10:21
 */

namespace stesi\invoice\models;

/**
 * This is the ActiveQuery class for [[InvVatCode]].
 *
 * @see InvVatCode
 */
class VatCodeQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return VatCode[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VatCode|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getVatValueWithCode(){
        return $this->addSelect(['id as id','CONCAT(vat,"% - ",code) as code']);
    }
}
