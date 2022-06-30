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
 * @property int $VID_OPLATY
 * @property string $GUID
 * @property string $STATUS
 * @property string $DATE_BEGIN
 * @property string $DATE_END
 * @property int $CNT
 */
class PayCheck extends ActiveRecord
{
    public $DATE_BEGIN;
    public $DATE_END;
    public $CNT;

    public static $checkType = [
        0 => 'Наличные',
        1 => 'Карта',
        2 => 'Другое'
    ];


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
            [['POS_ID', 'SMENA_ID', 'CHECKNO', 'EKR_CHECKNO', 'RET', 'M_MALE', 'M_AGE', 'ZAKAZNO', 'VID_OPLATY'], 'integer'],
            [['SUMMA', 'EKR_SUMMA'], 'number'],
            [['STAMP', 'DATE_BEGIN', 'DATE_END', 'CNT'], 'safe'],
            [['PUBLISHED'], 'string', 'max' => 1],
            [['GUID'], 'string', 'max' => 36],
            [['STATUS'], 'string', 'max' => 32],
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
            'PUBLISHED' => Yii::t('app', 'Опубликовано'),
            'RET' => Yii::t('app', 'Тип чека'),
            'M_MALE' => Yii::t('app', 'M  Male'),
            'M_AGE' => Yii::t('app', 'M  Age'),
            'ZAKAZNO' => Yii::t('app', 'Zakazno'),
            'VID_OPLATY' => Yii::t('app', 'Vid Oplaty'),
            'DATE_BEGIN' => Yii::t('app', 'Период с ...'),
            'DATE_END' => Yii::t('app', 'Период до ...'),
            'CNT' => Yii::t('app', 'Количество'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmena()
    {
        return $this->hasOne(Smena::className(), ['SMENA_ID'=>'SMENA_ID', 'POS_ID'=>'POS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBpos()
    {
        return $this->hasOne(Bpos::className(), ['POS_ID' => 'POS_ID']);
    }

}
