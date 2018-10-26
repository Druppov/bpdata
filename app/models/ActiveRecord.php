<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * ActiveRecord model
 *
 * set timestamp behavior by default for all inherited models.
 */
abstract class ActiveRecord extends \yii\db\ActiveRecord
{
    public static $valuePublished = [
        'P' => 'Да',
        'U' => 'Нет'
    ];

    public static $valueYesNo = [
        'Y' => 'Да',
        'N' => 'Нет'
    ];

    public static function getBposFilter($searchModel, $idSmenaSelector=null)
    {
        return \yii\helpers\Html::activeDropDownList(
            $searchModel,
            'POS_ID',
            Bpos::find()
                ->select(['POS_NAME','POS_ID'])
                ->indexBy('POS_ID')
                ->column(),
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
