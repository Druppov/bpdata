<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PacketIn;

/**
 * PacketInSearch represents the model behind the search form of `app\models\PacketIn`.
 */
class PacketInSearch extends PacketIn
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'PACKETNO'], 'integer'],
            [['PACKETFILENAME', 'DATA', 'PROCESSED'], 'safe'],
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
        $query = PacketIn::find();

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
            'PACKETNO' => $this->PACKETNO,
        ]);

        $query->andFilterWhere(['like', 'PACKETFILENAME', $this->PACKETFILENAME])
            ->andFilterWhere(['like', 'DATA', $this->DATA])
            ->andFilterWhere(['like', 'PROCESSED', $this->PROCESSED]);

        return $dataProvider;
    }
}
