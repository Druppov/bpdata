<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PAYCHECKS".
 *
 * @property int $POS_ID
 * @property int $SMENA_ID
 * @property int $CHECKNO
 * @property double $SUMMA
 * @property int $EKR_CHECKNO
 * @property double $EKR_SUMMA
 * @property string $STAMP
 * @property string $PUBLISHED
 * @property int $RET
 * @property int $M_MALE
 * @property int $M_AGE
 * @property int $ZAKAZNO
 */
class PayCheck extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PAYCHECKS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'SMENA_ID', 'CHECKNO'], 'required'],
            [['POS_ID', 'SMENA_ID', 'CHECKNO', 'EKR_CHECKNO', 'RET', 'M_MALE', 'M_AGE', 'ZAKAZNO'], 'integer'],
            [['SUMMA', 'EKR_SUMMA'], 'number'],
            [['STAMP'], 'safe'],
            [['PUBLISHED'], 'string', 'max' => 1],
            [['POS_ID', 'SMENA_ID', 'CHECKNO'], 'unique', 'targetAttribute' => ['POS_ID', 'SMENA_ID', 'CHECKNO']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'POS_ID' => Yii::t('app', 'Точка продаж'),
            'SMENA_ID' => Yii::t('app', 'Смена'),
            'CHECKNO' => Yii::t('app', 'Checkno'),
            'SUMMA' => Yii::t('app', 'Сумма'),
            'EKR_CHECKNO' => Yii::t('app', 'Ekr  Checkno'),
            'EKR_SUMMA' => Yii::t('app', 'Ekr  Summa'),
            'STAMP' => Yii::t('app', 'Stamp'),
            'PUBLISHED' => Yii::t('app', 'Published'),
            'RET' => Yii::t('app', 'Ret'),
            'M_MALE' => Yii::t('app', 'M  Male'),
            'M_AGE' => Yii::t('app', 'M  Age'),
            'ZAKAZNO' => Yii::t('app', 'Zakazno'),
        ];
    }
}
