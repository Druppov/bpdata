<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tovar;

/**
 * TovarSearch represents the model behind the search form of `app\models\Tovar`.
 */
class TovarSearch extends Tovar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TOVAR_ID', 'TYPE_ID', 'TAX_ID', 'FKEY_1C'], 'integer'],
            [['NAME', 'PRINTNAME', 'ISACTIVE', 'PUBLISHED'], 'safe'],
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
        $query = Tovar::find();

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
            'TOVAR_ID' => $this->TOVAR_ID,
            'TYPE_ID' => $this->TYPE_ID,
            'TAX_ID' => $this->TAX_ID,
            'FKEY_1C' => $this->FKEY_1C,
        ]);

        $query->andFilterWhere(['like', 'NAME', $this->NAME])
            ->andFilterWhere(['like', 'PRINTNAME', $this->PRINTNAME])
            ->andFilterWhere(['like', 'ISACTIVE', $this->ISACTIVE]);

        return $dataProvider;
    }
}
