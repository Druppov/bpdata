<?php

namespace app\modules\admin\models;

use app\models\Tovar;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Balance;

/**
 * BalanceSearch represents the model behind the search form of `app\models\Balance`.
 */
class BalanceSearch extends Balance
{
    public $TOVAR_NAME;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'TOVAR_ID'], 'integer'],
            [['BALANCEDATE', 'PUBLISHED', 'TOVAR_NAME'], 'safe'],
            [['AMOUNT'], 'number'],
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
        $query = Balance::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->innerJoinWith(['tovar']);

        $dataProvider->sort->attributes['TOVAR_NAME'] = [
            'asc' => [Tovar::tableName().'.{{%NAME}}' => SORT_ASC],
            'desc' => [Tovar::tableName().'.{{%NAME}}' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            '{{%POS_ID}}' => $this->POS_ID,
            //'BALANCEDATE' => date('Y-m-d', strtotime($this->BALANCEDATE)),
            '{{%TOVAR_ID}}' => $this->TOVAR_ID,
            '{{%AMOUNT}}' => $this->AMOUNT,
        ]);

        if (isset($this->BALANCEDATE) && !empty($this->BALANCEDATE)) {
            $query->andFilterWhere(['{{%BALANCEDATE}}' => date('Y-m-d', strtotime($this->BALANCEDATE))]);
        }

        $query->andFilterWhere(['like', '{{%PUBLISHED}}', $this->PUBLISHED])
            ->andFilterWhere(['like', Tovar::tableName().'.{{%NAME}}', $this->TOVAR_NAME]);

        return $dataProvider;
    }
}
