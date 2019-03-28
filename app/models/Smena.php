<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "SMENY".
 *
 * @property int $POS_ID
 * @property int $SMENA_ID
 * @property string $DATEOPEN
 * @property string $DATECLOSE
 * @property int $CHIEF
 * @property int $ZOTCHENO
 * @property string $PUBLISHED
 */
class Smena extends ActiveRecord
{
    public static $valuePublished = [
        'P' => 'Да',
        'U' => 'Нет'
    ];

    public $data;

    public static function getSmenaList($pos_id)
    {
        $smenaList = [];
        $smenas = Smena::find()
            ->where(['POS_ID'=>$pos_id])
            ->orderBy('DATEOPEN DESC')
            ->all();
        if (!empty($smenas)) {
            foreach($smenas as $smena) {
                $smenaList[$smena->SMENA_ID] = sprintf("[%s|%s]", date("d.m.Y",strtotime($smena->DATEOPEN)), $smena->personal->FIO);
            }
        }

        return $smenaList;
    }

    public static function getSmenaName($POS_ID, $SMENA_ID)
    {
        $smena = Smena::find()->where(['POS_ID'=>$POS_ID, 'SMENA_ID'=>$SMENA_ID])->one();
        return empty($smena) ? '' : sprintf("[%s|%s]", date("d.m.Y",strtotime($smena->DATEOPEN)), $smena->personal->FIO);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SMENY';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID'], 'required'],
            [['POS_ID', 'CHIEF', 'ZOTCHENO'], 'integer'],
            [['DATEOPEN', 'DATECLOSE', 'SMENA_ID', 'data'], 'safe'],
            [['PUBLISHED'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'POS_ID' => Yii::t('app', 'Точка продаж'),
            'SMENA_ID' => Yii::t('app', 'ID'),
            'DATEOPEN' => Yii::t('app', 'Дата открытия'),
            'DATECLOSE' => Yii::t('app', 'Дата закрытия'),
            'CHIEF' => Yii::t('app', 'Начальник'),
            'ZOTCHENO' => Yii::t('app', 'Zotcheno'),
            'PUBLISHED' => Yii::t('app', 'Опубликовано'),
        ];
    }

    protected function beforeFind()
    {
        $this->data = sprintf("[%s|%s]", date("d.m.Y",strtotime($this->DATEOPEN)), $this->personal->FIO);
        parent::beforeFind();
    }

    public function getData()
    {
        //return sprintf("[%s|%s]", date("d.m.Y",strtotime($this->DATEOPEN)), $this->personal->FIO);
        //return $this->SMENA_ID;
        return $this->data;
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
    public function getPersonal()
    {
        return $this->hasOne(Personal::className(), ['PERSON_ID' => 'CHIEF']);
    }
}
