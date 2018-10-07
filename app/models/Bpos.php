<?php

namespace app\models;

use Yii;

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
        'U' => 'Yes',
        'N' => 'No'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'BPOS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'POS_NAME'], 'required'],
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
            'POS_ID' => Yii::t('app', 'ID'),
            'POS_NAME' => Yii::t('app', 'Name'),
            'ADDR' => Yii::t('app', 'Address'),
            'PUBLISHED' => Yii::t('app', 'Published'),
        ];
    }
}
