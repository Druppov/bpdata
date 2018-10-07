<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TovarType;

/**
 * TovarTypeSearch represents the model behind the search form of `app\models\TovarType`.
 */
class TovarTypeSearch extends TovarType
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TYPE_ID'], 'integer'],
            [['TYPE_NAME', 'SHOWASCATEGORY', 'PUBLISHED'], 'safe'],
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
        $query = TovarType::find();

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
            'TYPE_ID' => $this->TYPE_ID,
        ]);

        $query->andFilterWhere(['like', 'TYPE_NAME', $this->TYPE_NAME])
            ->andFilterWhere(['like', 'SHOWASCATEGORY', $this->SHOWASCATEGORY])
            ->andFilterWhere(['like', 'PUBLISHED', $this->PUBLISHED]);

        return $dataProvider;
    }
}
