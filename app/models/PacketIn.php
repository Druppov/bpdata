<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "MGTPACKETS_IN".
 *
 * @property int $POS_ID
 * @property int $PACKETNO
 * @property string $PACKETFILENAME
 * @property resource $DATA
 * @property string $PROCESSED
 */
class PacketIn extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'MGTPACKETS_IN';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'PACKETNO'], 'required'],
            [['POS_ID', 'PACKETNO'], 'integer'],
            [['DATA'], 'string'],
            [['PACKETFILENAME'], 'string', 'max' => 25],
            [['PROCESSED'], 'string', 'max' => 1],
            [['POS_ID', 'PACKETNO'], 'unique', 'targetAttribute' => ['POS_ID', 'PACKETNO']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'POS_ID' => Yii::t('app', 'Pos  ID'),
            'PACKETNO' => Yii::t('app', 'Packetno'),
            'PACKETFILENAME' => Yii::t('app', 'Packetfilename'),
            'DATA' => Yii::t('app', 'Data'),
            'PROCESSED' => Yii::t('app', 'Processed'),
        ];
    }
}
