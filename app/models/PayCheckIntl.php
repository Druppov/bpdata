<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PCHECKS_INTL".
 *
 * @property int $POS_ID
 * @property int $SMENA_ID
 * @property int $CHECKNO
 * @property double $SUMMA
 * @property string $STAMP
 * @property int $RASHOD_ID
 * @property int $PERSON_ID
 * @property string $PUBLISHED
 */
class PayCheckIntl extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PCHECKS_INTL';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'SMENA_ID', 'CHECKNO'], 'required'],
            [['POS_ID', 'SMENA_ID', 'CHECKNO', 'RASHOD_ID', 'PERSON_ID'], 'integer'],
            [['SUMMA'], 'number'],
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
            'POS_ID' => Yii::t('app', 'Pos  ID'),
            'SMENA_ID' => Yii::t('app', 'Smena  ID'),
            'CHECKNO' => Yii::t('app', 'Checkno'),
            'SUMMA' => Yii::t('app', 'Summa'),
            'STAMP' => Yii::t('app', 'Stamp'),
            'RASHOD_ID' => Yii::t('app', 'Rashod  ID'),
            'PERSON_ID' => Yii::t('app', 'Person  ID'),
            'PUBLISHED' => Yii::t('app', 'Published'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRashodType()
    {
        return $this->hasOne(RashodType::className(), ['ID' => 'RASHOD_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonal()
    {
        return $this->hasOne(Personal::className(), ['PERSON_ID' => 'PERSON_ID']);
    }
}
