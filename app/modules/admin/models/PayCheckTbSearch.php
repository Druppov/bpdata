<?php

namespace app\modules\admin\models;

use app\models\PayCheck;
use app\models\Tovar;
use phpDocumentor\Reflection\Types\Self_;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PayCheckTb;

/**
 * PayCheckTbSearch represents the model behind the search form of `app\models\PayCheckTb`.
 */
class PayCheckTbSearch extends PayCheckTb
{
    public $SMENA_ID;
    public $RET;
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
            [['PUBLISHED', 'SMENA_ID', 'RET', 'TOVAR_NAME', 'IS_GROUP'], 'safe'],
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
        $query = PayCheckTb::find();

        // add conditions that should always apply here
        $query->joinWith(['payCheck', 'tovar']);
        if ($this->IS_GROUP) {
            $query->select([
                self::tableName().'.POS_ID',
                PayCheck::tableName().'.SMENA_ID',
                PayCheck::tableName().'.RET',
                self::tableName().'.CHECKNO',
                self::tableName().'.TOVAR_ID',
                'SUM(KVO) AS KVO',
                self::tableName().'.PRICE',
                'SUM('.self::tableName().'.SUMMA) AS SUMMA',
            ])
                ->groupBy([
                    self::tableName().'.POS_ID',
                    PayCheck::tableName().'.SMENA_ID',
                    //self::tableName().'.CHECKNO',
                    self::tableName().'.TOVAR_ID',
                ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['SMENA_ID'] = [
            'asc' => [PayCheck::tableName().'.SMENA_ID' => SORT_ASC],
            'desc' => [PayCheck::tableName().'.SMENA_ID' => SORT_DESC],
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

        $query->andFilterWhere([PayCheck::tableName().'.SMENA_ID'=>$this->SMENA_ID])
            ->andFilterWhere([PayCheck::tableName().'.RET'=>$this->RET])
            ->andFilterWhere(['like', Tovar::tableName().'.NAME', $this->TOVAR_NAME])
        ;

        return $dataProvider;
    }
}
