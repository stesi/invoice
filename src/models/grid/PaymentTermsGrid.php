<?php

namespace stesi\core\models\base\StesiModel\models\grid;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * PaymentTermsGrid represents the model behind the search form about `stesi\billing\models\PaymentTerms`.
 */
class PaymentTermsGrid extends yii\db\ActiveRecord
{

    public $globalSearch;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'safe'],
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
        $query = PaymentTermsGrid::find();

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

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
