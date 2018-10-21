<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "SMENY_TB".
 *
 * @property int $POS_ID
 * @property int $SMENA_ID
 * @property int $PERSON_ID
 * @property string $TIME_START
 * @property string $TIME_END
 * @property int $WORK_ID
 * @property string $PUBLISHED
 */
class SmenaTb extends ActiveRecord
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
        return 'SMENY_TB';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'SMENA_ID', 'PERSON_ID', 'WORK_ID', 'PUBLISHED'], 'required'],
            [['POS_ID', 'SMENA_ID', 'PERSON_ID', 'WORK_ID'], 'integer'],
            [['TIME_START', 'TIME_END'], 'safe'],
            [['PUBLISHED'], 'string', 'max' => 1],
            [['POS_ID', 'SMENA_ID', 'PERSON_ID'], 'unique', 'targetAttribute' => ['POS_ID', 'SMENA_ID', 'PERSON_ID']],
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
            'PERSON_ID' => Yii::t('app', 'ФИО'),
            'TIME_START' => Yii::t('app', 'Время начала'),
            'TIME_END' => Yii::t('app', 'Время завершения'),
            'WORK_ID' => Yii::t('app', 'Должность'),
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
    public function getSmena()
    {
        return $this->hasOne(Smena::className(), ['SMENA_ID'=>'SMENA_ID', 'POS_ID'=>'POS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWork()
    {
        return $this->hasOne(Work::className(), ['WORK_ID' => 'WORK_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonal()
    {
        return $this->hasOne(Personal::className(), ['PERSON_ID' => 'PERSON_ID']);
    }
}
