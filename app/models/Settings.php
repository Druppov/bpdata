<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property string $section_name
 * @property string $key
 * @property resource $value
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['section_name', 'key'], 'required'],
            [['value'], 'string'],
            [['section_name', 'key'], 'string', 'max' => 255],
            [['section_name', 'key'], 'unique', 'targetAttribute' => ['section_name', 'key']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'section_name' => Yii::t('app', 'Section Name'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    public static function getValue($sectionName, $key)
    {
        $model = Settings::find()->where(['section_name'=>$sectionName, 'key'=>$key])->one();
        return isset($model->value) ? $model->value : '';
    }
}
