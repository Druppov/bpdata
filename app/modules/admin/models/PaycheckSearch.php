<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Paycheck;

/**
 * PaycheckSearch represents the model behind the search form of `app\models\Paycheck`.
 */
class PaycheckSearch extends Paycheck
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'SMENA_ID', 'CHECKNO', 'EKR_CHECKNO', 'RET', 'M_MALE', 'M_AGE', 'ZAKAZNO', 'VID_OPLATY'], 'integer'],
            [['SUMMA', 'EKR_SUMMA'], 'number'],
            [['STAMP', 'PUBLISHED', 'GUID', 'STATUS', 'DATE_BEGIN', 'DATE_END', 'CNT'], 'safe'],
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
        $query = Paycheck::find();

        $query->select([
            self::tableName().'.POS_ID',
            self::tableName().'.PUBLISHED',
            self::tableName().'.STAMP',
            self::tableName().'.RET',
            'COUNT(*) AS CNT',
            'SUM('.self::tableName().'.SUMMA) AS SUMMA',
        ])->groupBy([
            self::tableName().'.POS_ID',
            self::tableName().'.PUBLISHED',
            self::tableName().'.RET',
        ]);

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
            'PUBLISHED' => $this->PUBLISHED,
            'RET' => $this->RET,
            'CNT' => $this->CNT,
//            'SMENA_ID' => $this->SMENA_ID,
//            'CHECKNO' => $this->CHECKNO,
//            'SUMMA' => $this->SUMMA,
//            'EKR_CHECKNO' => $this->EKR_CHECKNO,
//            'EKR_SUMMA' => $this->EKR_SUMMA,
//            'STAMP' => $this->STAMP,
//            'RET' => $this->RET,
//            'M_MALE' => $this->M_MALE,
//            'M_AGE' => $this->M_AGE,
//            'ZAKAZNO' => $this->ZAKAZNO,
//            'VID_OPLATY' => $this->VID_OPLATY,
        ]);

        if ($this->DATE_BEGIN) {
            $query->andFilterWhere(['>=', 'DATE(STAMP)', $this->DATE_BEGIN]);
        }

        if ($this->DATE_END) {
            $query->andFilterWhere(['<=', 'DATE(STAMP)', $this->DATE_END]);
        }

        $query->andFilterWhere(['like', 'PUBLISHED', $this->PUBLISHED]);

        return $dataProvider;
    }
}
