<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PAYCHECKS_TB".
 *
 * @property int $POS_ID
 * @property int $CHECKNO
 * @property int $STRNO
 * @property int $TOVAR_ID
 * @property int $KVO
 * @property double $PRICE
 * @property double $SUMMA
 * @property string $PUBLISHED
 * @property int $ROW_NPP
 */
class PayCheckTb extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PAYCHECKS_TB';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'CHECKNO', 'STRNO', 'TOVAR_ID', 'PUBLISHED'], 'required'],
            [['POS_ID', 'CHECKNO', 'STRNO', 'TOVAR_ID', 'KVO', 'ROW_NPP'], 'integer'],
            [['PRICE', 'SUMMA'], 'number'],
            [['PUBLISHED'], 'string', 'max' => 1],
            [['POS_ID', 'CHECKNO', 'STRNO'], 'unique', 'targetAttribute' => ['POS_ID', 'CHECKNO', 'STRNO']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'POS_ID' => Yii::t('app', 'Точка продаж'),
            'CHECKNO' => Yii::t('app', 'Checkno'),
            'STRNO' => Yii::t('app', 'Strno'),
            'TOVAR_ID' => Yii::t('app', 'Наименование'),
            'KVO' => Yii::t('app', 'Количество'),
            'PRICE' => Yii::t('app', 'Цена'),
            'SUMMA' => Yii::t('app', 'Сумма'),
            'PUBLISHED' => Yii::t('app', 'Опубликовано'),
            'ROW_NPP' => Yii::t('app', '№'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayCheck()
    {
        return $this->hasOne(PayCheck::className(), ['CHECKNO'=>'CHECKNO', 'POS_ID'=>'POS_ID']);
    }
}
