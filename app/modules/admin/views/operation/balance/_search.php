<?php

use app\models\Bpos;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BalanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="balance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['balance-index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'POS_ID')->dropDownList(
        //Bpos::find()->select(['POS_NAME', 'POS_ID'])->indexBy('POS_ID')->column(),
        Bpos::getBposList(),
        [
            'id' => 'balancesearch-pos-id',
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

    <?= $form->field($model, 'BALANCEDATE')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Введите дату ...'],
        'value' => date('Y-m-d'),
        'pluginOptions' => [
            'autoclose'=>true,
            'language' => 'ru',
            'format' => 'dd.mm.yyyy'
            //'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?//= $form->field($model, 'TOVAR_ID') ?>

    <?//= $form->field($model, 'AMOUNT') ?>

    <?//= $form->field($model, 'PUBLISHED') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Применить'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Отмена'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
