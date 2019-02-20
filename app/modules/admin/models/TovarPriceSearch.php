<?php

namespace app\modules\admin\models;

use app\models\Bpos;
use app\models\Tovar;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TovarPrice;
use yii\db\Expression;

/**
 * TovarProceSearch represents the model behind the search form of `app\models\TovarPrice`.
 */
class TovarPriceSearch extends TovarPrice
{
    public $TOVAR_NAME;
    public $IS_USE_MAX_DATE = false;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'TOVAR_ID'], 'integer'],
            [['PRICE_DATE', 'PUBLISHED', 'ISUSED', 'POS_NAME', 'TOVAR_NAME', 'IS_USE_MAX_DATE'], 'safe'],
            [['PRICE_VALUE'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'IS_USE_MAX_DATE' => Yii::t('app', 'Последние данные'),
        ]);
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
        $query->innerJoinWith(['tovar']);

        /*
        if ($this->IS_USE_MAX_DATE && empty($this->PRICE_DATE)) {
            $subQuery = TovarPrice::find()
                ->alias('tv2')
                ->select('tv2.`POS_ID`,tv2.`TOVAR_ID`,MAX(tv2.PRICE_DATE) AS `PRICE_DATE`')
                ->groupBy('tv2.`POS_ID`,tv2.`TOVAR_ID`');

            $query->leftJoin(
                ['tvg' => $subQuery],
                '`TOVARY_PRICES`.`POS_ID`=tvg.POS_ID AND `TOVARY_PRICES`.`TOVAR_ID`=tvg.TOVAR_ID AND `TOVARY_PRICES`.`PRICE_DATE`=tvg.PRICE_DATE'
            );
        } else {
            $query->orderBy(['PRICE_DATE'=>SORT_DESC]);
        }
        */

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
            self::tableName().'.POS_ID' => $this->POS_ID,
            self::tableName().'.TOVAR_ID' => $this->TOVAR_ID,
            //self::tableName().'.PRICE_DATE' => $this->PRICE_DATE,
            self::tableName().'.PRICE_VALUE' => $this->PRICE_VALUE,
        ]);

        //if ($this->IS_USE_MAX_DATE && !empty($this->PRICE_DATE)) {
        //    $query->andFilterWhere(['>=', self::tableName().'.PRICE_DATE', date('Y-m-d',strtotime($this->PRICE_DATE))]);
        //} elseif ($this->IS_USE_MAX_DATE && empty($this->PRICE_DATE)) {
        if ($this->IS_USE_MAX_DATE && empty($this->PRICE_DATE)) {
            //$query->andFilterWhere(['IS NOT', 'tvg.PRICE_DATE', new Expression('null')]);
            $subQuery = TovarPrice::find()
                ->alias('tv2')
                ->select('tv2.`POS_ID`,tv2.`TOVAR_ID`,MAX(tv2.PRICE_DATE) AS `PRICE_DATE`')
                ->groupBy('tv2.`POS_ID`,tv2.`TOVAR_ID`');

            $query->innerJoin(
                ['tvg' => $subQuery],
                '`TOVARY_PRICES`.`POS_ID`=tvg.POS_ID AND `TOVARY_PRICES`.`TOVAR_ID`=tvg.TOVAR_ID AND `TOVARY_PRICES`.`PRICE_DATE`=tvg.PRICE_DATE'
            );
        } elseif (!empty($this->PRICE_DATE)) {
            //$query->andFilterWhere(['<=', self::tableName().'.PRICE_DATE', date('Y-m-d',strtotime($this->PRICE_DATE))]);
            $subQuery = TovarPrice::find()
                ->alias('tv2')
                ->select('tv2.`POS_ID`,tv2.`TOVAR_ID`,MAX(tv2.PRICE_DATE) AS `PRICE_DATE`')
                ->where(['<=', 'tv2.PRICE_DATE', date('Y-m-d',strtotime($this->PRICE_DATE))])
                ->groupBy('tv2.`POS_ID`,tv2.`TOVAR_ID`');

            $query->innerJoin(
                ['tvg' => $subQuery],
                '`TOVARY_PRICES`.`POS_ID`=tvg.POS_ID AND `TOVARY_PRICES`.`TOVAR_ID`=tvg.TOVAR_ID AND `TOVARY_PRICES`.`PRICE_DATE`=tvg.PRICE_DATE'
            );
        }

        $query->andFilterWhere(['like', self::tableName().'.PUBLISHED', $this->PUBLISHED])
            ->andFilterWhere(['like', self::tableName().'.ISUSED', $this->ISUSED])
            ->andFilterWhere(['like', Tovar::tableName().'.NAME', $this->TOVAR_NAME]);

        return $dataProvider;
    }
}
