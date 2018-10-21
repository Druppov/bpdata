<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Smena;

/**
 * SmenaSearch represents the model behind the search form of `app\models\Smena`.
 */
class SmenaSearch extends Smena
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'SMENA_ID', 'CHIEF', 'ZOTCHENO'], 'integer'],
            [['DATEOPEN', 'DATECLOSE', 'PUBLISHED'], 'safe'],
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
        $query = Smena::find();

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
            'DATEOPEN' => $this->DATEOPEN,
            'DATECLOSE' => $this->DATECLOSE,
            'CHIEF' => $this->CHIEF,
            'ZOTCHENO' => $this->ZOTCHENO,
        ]);

        $query->andFilterWhere(['like', 'PUBLISHED', $this->PUBLISHED]);

        return $dataProvider;
    }
}
