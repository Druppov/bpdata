<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "INTL_RASHOD".
 *
 * @property int $ID
 * @property string $RASHODNAME
 * @property string $PUBLISHED
 */
class RashodType extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'INTL_RASHOD';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'PUBLISHED'], 'required'],
            [['ID'], 'integer'],
            [['RASHODNAME'], 'string', 'max' => 40],
            [['PUBLISHED'], 'string', 'max' => 1],
            [['ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'RASHODNAME' => Yii::t('app', 'Rashodname'),
            'PUBLISHED' => Yii::t('app', 'Published'),
        ];
    }
}
