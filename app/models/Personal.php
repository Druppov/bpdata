<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PERSONAL".
 *
 * @property int $PERSON_ID
 * @property string $FIO
 * @property string $ISACTIVE
 * @property string $PUBLISHED
 */
class Personal extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PERSONAL';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FIO', 'PUBLISHED'], 'required'],
            [['PERSON_ID'], 'integer'],
            [['FIO'], 'string', 'max' => 60],
            [['ISACTIVE', 'PUBLISHED'], 'string', 'max' => 1],
            [['PERSON_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PERSON_ID' => Yii::t('app', '№'),
            'FIO' => Yii::t('app', 'ФИО'),
            'ISACTIVE' => Yii::t('app', 'Активность'),
            'PUBLISHED' => Yii::t('app', 'Опубликовано'),
        ];
    }
}
