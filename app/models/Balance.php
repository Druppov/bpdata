<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "BALANCES".
 *
 * @property int $POS_ID
 * @property string $BALANCEDATE
 * @property int $TOVAR_ID
 * @property double $AMOUNT
 * @property string $PUBLISHED
 */
class Balance extends ActiveRecord
{
    public static $valuePublished = [
        'P' => 'Да',
        'U' => 'Нет'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'BALANCES';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'BALANCEDATE', 'TOVAR_ID'], 'required'],
            [['POS_ID', 'TOVAR_ID'], 'integer'],
            [['BALANCEDATE'], 'safe'],
            [['AMOUNT'], 'number'],
            [['PUBLISHED'], 'string', 'max' => 1],
            [['POS_ID', 'BALANCEDATE', 'TOVAR_ID'], 'unique', 'targetAttribute' => ['POS_ID', 'BALANCEDATE', 'TOVAR_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'POS_ID' => Yii::t('app', 'Торговая точка'),
            'BALANCEDATE' => Yii::t('app', 'Дата'),
            'TOVAR_ID' => Yii::t('app', 'Товар'),
            'AMOUNT' => Yii::t('app', 'Количество'),
            'PUBLISHED' => Yii::t('app', 'Опубликовано'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBpos()
    {
        return $this->hasOne(Bpos::className(), ['POS_ID' => 'POS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTovar()
    {
        return $this->hasOne(Tovar::className(), ['TOVAR_ID' => 'TOVAR_ID']);
    }
}
