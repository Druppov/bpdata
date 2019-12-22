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
 * @property string $PRICE_DATE
 * @property double $PRICE_VALUE
 */
class Tovar extends ActiveRecord
{
    public $PRICE_DATE;
    public $PRICE_VALUE;
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
            [['TAX_ID','NAME', 'PRINTNAME','ISACTIVE'], 'required'],
            [['TOVAR_ID', 'TYPE_ID', 'TAX_ID', 'FKEY_1C'], 'integer'],
            [['NAME', 'PRINTNAME'], 'string', 'max' => 60],
            [['ISACTIVE', 'PUBLISHED'], 'string', 'max' => 1],
            [['PRICE_DATE'], 'safe'],
            [['PRICE_VALUE'], 'number'],
            [['TOVAR_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TOVAR_ID' => Yii::t('app', '№'),
            'NAME' => Yii::t('app', 'Наименование'),
            'PRINTNAME' => Yii::t('app', 'Для печати'),
            'TYPE_ID' => Yii::t('app', 'Товар'),
            'TAX_ID' => Yii::t('app', 'Tax ID'),
            'ISACTIVE' => Yii::t('app', 'Активно'),
            'PUBLISHED' => Yii::t('app', 'Published'),
            'FKEY_1C' => Yii::t('app', 'Ключ 1C'),
            'PRICE_DATE' => Yii::t('app', 'Дата цены'),
            'PRICE_VALUE' => Yii::t('app', 'Цена'),
            'PUBLISHED' => Yii::t('app', 'Опубликовано')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTovarPrices()
    {
        return $this->hasMany(TovarPrice::className(), ['TOVAR_ID'=>'TOVAR_ID']);
    }
}
