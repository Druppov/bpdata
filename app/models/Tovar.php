<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TOVARY".
 *
 * @property int $TOVAR_ID
 * @property string $NAME
 * @property string $PRINTNAME
 * @property int $TYPE_ID
 * @property int $TAX_ID
 * @property string $ISACTIVE
 * @property string $PUBLISHED
 * @property int $FKEY_1C
 */
class Tovar extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TOVARY';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TOVAR_ID', 'TAX_ID'], 'required'],
            [['TOVAR_ID', 'TYPE_ID', 'TAX_ID', 'FKEY_1C'], 'integer'],
            [['NAME', 'PRINTNAME'], 'string', 'max' => 60],
            [['ISACTIVE', 'PUBLISHED'], 'string', 'max' => 1],
            [['TOVAR_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TOVAR_ID' => Yii::t('app', 'ID'),
            'NAME' => Yii::t('app', 'Name'),
            'PRINTNAME' => Yii::t('app', 'Printname'),
            'TYPE_ID' => Yii::t('app', 'Type ID'),
            'TAX_ID' => Yii::t('app', 'Tax ID'),
            'ISACTIVE' => Yii::t('app', 'Is Active'),
            'PUBLISHED' => Yii::t('app', 'Published'),
            'FKEY_1C' => Yii::t('app', 'Fkey 1C'),
        ];
    }
}
