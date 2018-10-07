<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TOVARY_PRICES".
 *
 * @property int $POS_ID
 * @property int $TOVAR_ID
 * @property string $PRICE_DATE
 * @property double $PRICE_VALUE
 * @property string $PUBLISHED
 * @property string $ISUSED
 */
class TovarPrice extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TOVARY_PRICES';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'TOVAR_ID', 'PRICE_DATE'], 'required'],
            [['POS_ID', 'TOVAR_ID'], 'integer'],
            [['PRICE_DATE'], 'safe'],
            [['PRICE_VALUE'], 'number'],
            [['PUBLISHED', 'ISUSED'], 'string', 'max' => 1],
            [['POS_ID', 'TOVAR_ID', 'PRICE_DATE'], 'unique', 'targetAttribute' => ['POS_ID', 'TOVAR_ID', 'PRICE_DATE']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'POS_ID' => Yii::t('app', 'Pos'),
            'TOVAR_ID' => Yii::t('app', 'Tovar'),
            'PRICE_DATE' => Yii::t('app', 'Price Date'),
            'PRICE_VALUE' => Yii::t('app', 'Price Value'),
            'PUBLISHED' => Yii::t('app', 'Published'),
            'ISUSED' => Yii::t('app', 'Is Used'),
        ];
    }
}
