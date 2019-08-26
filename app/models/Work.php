<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "WORKS".
 *
 * @property int $WORK_ID
 * @property string $WORKNAME
 * @property string $PUBLISHED
 * @property int ID
 */
class Work extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'WORKS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['WORKNAME'], 'required'],
            [['ID'], 'safe'],
            [['WORK_ID'], 'integer'],
            [['WORKNAME'], 'string', 'max' => 20],
            [['PUBLISHED'], 'string', 'max' => 1],
            [['WORK_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'WORK_ID' => Yii::t('app', '№'),
            'WORKNAME' => Yii::t('app', 'Название'),
            'PUBLISHED' => Yii::t('app', 'Видимость'),
        ];
    }
}
