<?php

namespace app\modules\admin\models;

use app\models\PayCheckIntl;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PayCheckIntlTb;
use app\models\Tovar;

/**
 * PayCheckIntlTbSearch represents the model behind the search form of `app\models\PayCheckIntlTb`.
 */
class PayCheckIntlTbSearch extends PayCheckIntlTb
{
    public $SMENA_ID;
    public $RASHOD_ID;
    public $PERSON_ID;
    public $TOVAR_NAME;
    public $IS_GROUP = false;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'CHECKNO', 'STRNO', 'TOVAR_ID', 'KVO', 'ROW_NPP'], 'integer'],
            [['PRICE', 'SUMMA'], 'number'],
            [['PUBLISHED', 'SMENA_ID', 'RASHOD_ID', 'PERSON_ID', 'TOVAR_NAME', 'IS_GROUP'], 'safe'],
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
        $query = PayCheckIntlTb::find();

        // add conditions that should always apply here
        $query->joinWith(['payCheckIntl', 'tovar']);
        if ($this->IS_GROUP) {
            $query->select([
                self::tableName().'.POS_ID',
                PayCheckIntl::tableName().'.SMENA_ID',
                PayCheckIntl::tableName().'.PERSON_ID',
                self::tableName().'.CHECKNO',
                self::tableName().'.TOVAR_ID',
                'SUM(KVO) AS KVO',
                self::tableName().'.PRICE',
                'SUM('.self::tableName().'.SUMMA) AS SUMMA',
            ])
                ->groupBy([
                    self::tableName().'.POS_ID',
                    PayCheckIntl::tableName().'.SMENA_ID',
                    PayCheckIntl::tableName().'.PERSON_ID',
                    self::tableName().'.TOVAR_ID',
                ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['RASHOD_ID'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => [PayCheckIntl::tableName().'.RASHOD_ID' => SORT_ASC],
            'desc' => [PayCheckIntl::tableName().'.RASHOD_ID' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['PERSON_ID'] = [
            'asc' => [PayCheckIntl::tableName().'.PERSON_ID' => SORT_ASC],
            'desc' => [PayCheckIntl::tableName().'.PERSON_ID' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['SMENA_ID'] = [
            'asc' => [PayCheckIntl::tableName().'.SMENA_ID' => SORT_ASC],
            'desc' => [PayCheckIntl::tableName().'.SMENA_ID' => SORT_DESC],
        ];
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
            self::tableName().'.POS_ID' => $this->POS_ID,
            //'CHECKNO' => $this->CHECKNO,
            //'STRNO' => $this->STRNO,
            'TOVAR_ID' => $this->TOVAR_ID,
            'KVO' => $this->KVO,
            'PRICE' => $this->PRICE,
            'SUMMA' => $this->SUMMA,
            //'ROW_NPP' => $this->ROW_NPP,
        ]);

        $query->andFilterWhere([PayCheckIntl::tableName().'.SMENA_ID'=>$this->SMENA_ID])
            //->andFilterWhere(['like', PayCheckIntl::tableName().'.PUBLISHED', $this->PUBLISHED])
            //->andFilterWhere([PayCheckIntl::tableName().'.RASHOD_ID'=>$this->RASHOD_ID])
            //->andFilterWhere([PayCheckIntl::tableName().'.PERSON_ID'=>$this->PERSON_ID])
            //->andFilterWhere(['like', Tovar::tableName().'.NAME', $this->TOVAR_NAME])
            ->andFilterWhere(['like', Tovar::tableName().'.NAME', $this->TOVAR_NAME]);

        if (!empty($this->POS_ID) && !empty($this->SMENA_ID)) {
            $dataProvider->pagination = false;
        }

        return $dataProvider;
    }
}
