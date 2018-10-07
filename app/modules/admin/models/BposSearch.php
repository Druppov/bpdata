<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bpos;

/**
 * BposSearch represents the model behind the search form of `app\models\Bpos`.
 */
class BposSearch extends Bpos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID'], 'integer'],
            [['POS_NAME', 'ADDR', 'PUBLISHED'], 'safe'],
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
        $query = Bpos::find();

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
        ]);

        $query->andFilterWhere(['like', 'POS_NAME', $this->POS_NAME])
            ->andFilterWhere(['like', 'ADDR', $this->ADDR])
            ->andFilterWhere(['like', 'PUBLISHED', $this->PUBLISHED]);

        return $dataProvider;
    }
}
