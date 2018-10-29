<?php

namespace app\modules\admin\models;

use app\models\Bpos;
use app\models\Tovar;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TovarPrice;

/**
 * TovarProceSearch represents the model behind the search form of `app\models\TovarPrice`.
 */
class TovarPriceSearch extends TovarPrice
{
    public $TOVAR_NAME;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'TOVAR_ID'], 'integer'],
            [['PRICE_DATE', 'PUBLISHED', 'ISUSED', 'POS_NAME', 'TOVAR_NAME'], 'safe'],
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
        $query->joinWith(['tovar']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['TOVAR_NAME'] = [
            'asc' => [Tovar::tableName().'.NAME' => SORT_ASC],
            'desc' => [Tovar::tableName().'.NAME' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'POS_ID' => $this->POS_ID,
            self::tableName().'.TOVAR_ID' => $this->TOVAR_ID,
            'PRICE_DATE' => $this->PRICE_DATE,
            'PRICE_VALUE' => $this->PRICE_VALUE,
        ]);

        $query->andFilterWhere(['like', 'PUBLISHED', $this->PUBLISHED])
            ->andFilterWhere(['like', 'ISUSED', $this->ISUSED])
            ->andFilterWhere(['like', Tovar::tableName().'.NAME', $this->TOVAR_NAME]);

        return $dataProvider;
    }
}
