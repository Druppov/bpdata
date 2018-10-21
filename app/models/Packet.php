<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "MGTPACKETS".
 *
 * @property int $POS_ID
 * @property int $DEST_POS_ID
 * @property int $PACKETNO
 * @property string $PACKETFILENAME
 * @property resource $DATA
 */
class Packet extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'MGTPACKETS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'DEST_POS_ID', 'PACKETNO'], 'required'],
            [['POS_ID', 'DEST_POS_ID', 'PACKETNO'], 'integer'],
            [['DATA'], 'string'],
            [['PACKETFILENAME'], 'string', 'max' => 25],
            [['POS_ID', 'DEST_POS_ID', 'PACKETNO'], 'unique', 'targetAttribute' => ['POS_ID', 'DEST_POS_ID', 'PACKETNO']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'POS_ID' => Yii::t('app', 'Pos  ID'),
            'DEST_POS_ID' => Yii::t('app', 'Dest  Pos  ID'),
            'PACKETNO' => Yii::t('app', 'Packetno'),
            'PACKETFILENAME' => Yii::t('app', 'Packetfilename'),
            'DATA' => Yii::t('app', 'Data'),
        ];
    }
}
