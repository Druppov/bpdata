<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\Html;

/**
 * ActiveRecord model
 *
 * set timestamp behavior by default for all inherited models.
 */
abstract class ActiveRecord extends \yii\db\ActiveRecord
{
    public static $valuePublishedP = 'P';
    public static $valuePublishedU = 'U';
    public static $valuePublished = [
        'P' => 'Да',
        'U' => 'Нет'
    ];

    public static $valueYes = 'Y';
    public static $valueNo = 'N';
    public static $valueYesNo = [
        'Y' => 'Да',
        'N' => 'Нет'
    ];

    public static function primaryKey()
    {
        return static::getTableSchema()->primaryKey;
    }

    public static function getBposFilter($searchModel, $idSmenaSelector=null)
    {
        return Html::activeDropDownList(
            $searchModel,
            'POS_ID',
            Bpos::getBposList(),
            [
                'class'=>'form-control',
                'prompt' => 'Все',
                'onchange' => is_null($idSmenaSelector) ? null : '
				    $.post( "'.Yii::$app->urlManager->createUrl('admin/operation/smena-lists?pos_id=').'"+$(this).val(), function( data ) {
				        $( "select#'.$idSmenaSelector.'" ).html( data );
				    });
			'
            ]
        );
    }

    /**
	 * @inheritdoc
	 */
    /*
	public function behaviors()
	{
		return [
			TimestampBehavior::class,
		];
	}
    */
}
