<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SmenaTb;

/**
 * SmenaTbSearch represents the model behind the search form of `app\models\SmenaTb`.
 */
class SmenaTbSearch extends SmenaTb
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'SMENA_ID', 'PERSON_ID', 'WORK_ID'], 'integer'],
            [['TIME_START', 'TIME_END', 'PUBLISHED'], 'safe'],
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
        $query = SmenaTb::find();

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
            'SMENA_ID' => $this->SMENA_ID,
            'PERSON_ID' => $this->PERSON_ID,
            'TIME_START' => $this->TIME_START,
            'TIME_END' => $this->TIME_END,
            'WORK_ID' => $this->WORK_ID,
        ]);

        $query->andFilterWhere(['like', 'PUBLISHED', $this->PUBLISHED]);

        return $dataProvider;
    }
}
