<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PCHECKS_INTL_TB".
 *
 * @property int $POS_ID
 * @property int $CHECKNO
 * @property int $STRNO
 * @property int $TOVAR_ID
 * @property int $KVO
 * @property double $PRICE
 * @property double $SUMMA
 * @property string $PUBLISHED
 * @property int $ROW_NPP
 */
class PayCheckIntlTb extends ActiveRecord
{
    public $smenaData;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PCHECKS_INTL_TB';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'CHECKNO', 'STRNO', 'TOVAR_ID', 'PUBLISHED'], 'required'],
            [['POS_ID', 'CHECKNO', 'STRNO', 'TOVAR_ID', 'KVO', 'ROW_NPP'], 'integer'],
            [['PRICE', 'SUMMA'], 'number'],
            [['PUBLISHED'], 'string', 'max' => 1],
            [['POS_ID', 'CHECKNO', 'STRNO'], 'unique', 'targetAttribute' => ['POS_ID', 'CHECKNO', 'STRNO']],
            [['smenaData'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'POS_ID' => Yii::t('app', 'Точка продаж'),
            'CHECKNO' => Yii::t('app', 'Checkno'),
            'STRNO' => Yii::t('app', '№'),
            'TOVAR_ID' => Yii::t('app', 'Наименование'),
            'KVO' => Yii::t('app', 'Количество'),
            'PRICE' => Yii::t('app', 'Цена'),
            'SUMMA' => Yii::t('app', 'Сумма'),
            'PUBLISHED' => Yii::t('app', 'Опубликовано'),
            'ROW_NPP' => Yii::t('app', '№'),
        ];
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
    public function getTovar()
    {
        return $this->hasOne(Tovar::className(), ['TOVAR_ID' => 'TOVAR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayCheckIntl()
    {
        return $this->hasOne(PayCheckIntl::className(), ['CHECKNO'=>'CHECKNO', 'POS_ID'=>'POS_ID']);
    }

    public function getSmenaData()
    {
        //return empty($this->payCheckIntl->smena) ? '' : sprintf("[%s|%s]", date("d.m.Y",strtotime($this->payCheckIntl->smena->DATEOPEN)), $this->payCheckIntl->smena->personal->FIO);
        //return $this->payCheckIntl->CHECKNO;
        return Smena::getSmenaName($this->POS_ID, $this->payCheckIntl->SMENA_ID);
    }
}
