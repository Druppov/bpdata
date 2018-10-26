<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TOVAR_TYPE".
 *
 * @property int $TYPE_ID
 * @property string $TYPE_NAME
 * @property string $SHOWASCATEGORY
 * @property string $PUBLISHED
 */
class TovarType extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TOVAR_TYPE';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TYPE_ID', 'TYPE_NAME'], 'required'],
            [['TYPE_ID'], 'integer'],
            [['TYPE_NAME'], 'string', 'max' => 40],
            [['SHOWASCATEGORY', 'PUBLISHED'], 'string', 'max' => 1],
            [['TYPE_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TYPE_ID' => Yii::t('app', '№'),
            'TYPE_NAME' => Yii::t('app', 'Наименование'),
            'SHOWASCATEGORY' => Yii::t('app', 'Активно'),
            'PUBLISHED' => Yii::t('app', 'Published'),
        ];
    }
}
