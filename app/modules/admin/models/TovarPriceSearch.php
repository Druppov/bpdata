<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TovarPrice;

/**
 * TovarProceSearch represents the model behind the search form of `app\models\TovarPrice`.
 */
class TovarPriceSearch extends TovarPrice
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'TOVAR_ID'], 'integer'],
            [['PRICE_DATE', 'PUBLISHED', 'ISUSED'], 'safe'],
            [['PRICE_VALUE'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = TovarPrice::find();

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
            'POS_ID' => $this->POS_ID,
            'TOVAR_ID' => $this->TOVAR_ID,
            'PRICE_DATE' => $this->PRICE_DATE,
            'PRICE_VALUE' => $this->PRICE_VALUE,
        ]);

        $query->andFilterWhere(['like', 'PUBLISHED', $this->PUBLISHED])
            ->andFilterWhere(['like', 'ISUSED', $this->ISUSED]);

        return $dataProvider;
    }
}
