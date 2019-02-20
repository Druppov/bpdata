<?php

use app\models\Bpos;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\TovarPriceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tovar-price-search">

    <?php $form = ActiveForm::begin([
        'action' => ['tovar-price-report'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'IS_USE_MAX_DATE')->checkbox(); ?>

    <?= $form->field($model, 'POS_ID')->dropDownList(
        Bpos::find()->select(['POS_NAME', 'POS_ID'])->indexBy('POS_ID')->column(),
        [
            'id' => 'tovarpricesearch-pos-id',
            'prompt'=>'Выберите точку продаж',
            /*
            'onchange'=>'
				$.post( "'.Yii::$app->urlManager->createUrl('admin/operation/smena-lists?pos_id=').'"+$(this).val(), function( data ) {
				  $( "select#smenatbsearch-smena-id" ).html( data );
				});
			'
            */
        ]
    ); ?>

    <?//= $form->field($model, 'TOVAR_ID') ?>

    <?= $form->field($model, 'PRICE_DATE')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Введите дату ...'],
        'value' => date('Y-m-d'),
        'pluginOptions' => [
            'autoclose'=>true,
            'language' => 'ru',
            'format' => 'dd.mm.yyyy'
            //'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?//= $form->field($model, 'PRICE_VALUE') ?>

    <?//= $form->field($model, 'PUBLISHED') ?>

    <?php // echo $form->field($model, 'ISUSED') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Применить'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Отмена'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
