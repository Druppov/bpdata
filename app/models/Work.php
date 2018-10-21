<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "WORKS".
 *
 * @property int $WORK_ID
 * @property string $WORKNAME
 * @property string $PUBLISHED
 */
class Work extends \yii\db\ActiveRecord
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
            [['WORK_ID', 'WORKNAME', 'PUBLISHED'], 'required'],
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
            'WORK_ID' => Yii::t('app', 'Work  ID'),
            'WORKNAME' => Yii::t('app', 'Workname'),
            'PUBLISHED' => Yii::t('app', 'Published'),
        ];
    }
}
