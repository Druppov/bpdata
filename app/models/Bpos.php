<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "BPOS".
 *
 * @property int $POS_ID
 * @property string $POS_NAME
 * @property string $ADDR
 * @property string $PUBLISHED
 */
class Bpos extends ActiveRecord
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
        return 'BPOS';
    }

    public static function getName($BPOS_ID)
    {
        $model = Bpos::findOne($BPOS_ID);

        return isset($model->POS_NAME) ? $model->POS_NAME : '';
    }

    public static function getBposList()
    {
        return self::find()
            ->select([new Expression("concat('[', POS_ID,'] ', POS_NAME) AS POS_NAME"),'POS_ID'])
            ->orderBy('POS_ID')
            ->indexBy('POS_ID')
            ->column();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_NAME'], 'required'],
            //[['POS_FULL_NAME'], 'safe'],
            [['POS_ID'], 'integer'],
            [['POS_NAME'], 'string', 'max' => 30],
            [['ADDR'], 'string', 'max' => 120],
            [['PUBLISHED'], 'string', 'max' => 1],
            [['POS_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'POS_ID' => Yii::t('app', '№'),
            'POS_NAME' => Yii::t('app', 'Название'),
            //'POS_FULL_NAME' => Yii::t('app', 'Название'),
            'ADDR' => Yii::t('app', 'Адрес'),
            'PUBLISHED' => Yii::t('app', 'Опубликовано'),
        ];
    }

    public function getPosFullName()
    {
        return '['.$this->POS_ID.'] '.$this->POS_NAME;
    }
}
