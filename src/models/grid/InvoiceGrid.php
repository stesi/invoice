<?php

namespace stesi\core\models\base\StesiModel\models\grid;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * InvoiceGrid represents the model behind the search form about `stesi\billing\models\Invoice`.
 */
class InvoiceGrid extends yii\db\ActiveRecord
{

    public $globalSearch;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'organization_from_id', 'organization_to_id', 'number', 'created_by', 'updated_by', 'payment_terms_id'], 'integer'],
            [['status', 'invoice_type', 'preamble', 'year', 'invoice_date', 'competence_date', 'created_at', 'updated_at', 'note','organization_from_code',
                'organization_from_name','organization_to_code','organization_to_name','payment_terms_name'], 'safe'],
            [['subtotal', 'tax', 'total'], 'number'],
            [['globalSearch'], 'safe'],
        ];
    }

    public static function primaryKey()
    {
        return ['id'];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = InvoiceGrid::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'organization_from_id' => $this->organization_from_id,
            'organization_to_id' => $this->organization_to_id,
            'number' => $this->number,
            'year' => $this->year,
            'invoice_date' => $this->invoice_date,
            'competence_date' => $this->competence_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'payment_terms_id' => $this->payment_terms_id,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'invoice_type', $this->invoice_type])
            ->andFilterWhere(['like', 'preamble', $this->preamble])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'organization_from_code', $this->organization_from_code])
            ->andFilterWhere(['like', 'organization_from_name', $this->organization_from_name])
            ->andFilterWhere(['like', 'organization_to_code', $this->organization_to_code])
            ->andFilterWhere(['like', 'organization_to_name', $this->organization_to_name])
            ->andFilterWhere(['like', 'payment_terms_name', $this->payment_terms_name]);

        //GlobalSearch
        $globalSearchField = array("or");
        foreach ($this->getGlobalSearchField() as $field) {
            array_push($globalSearchField, ['like', $field, $this->globalSearch]);
            }
        $query->andFilterWhere($globalSearchField);

        return $dataProvider;
    }

    /**
    * @return array
    */
    public function getGlobalSearchField()
    {
        return [];
    }
}
