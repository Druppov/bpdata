<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\TovarPrice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tovar-price-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'POS_ID')->dropDownList(\app\models\Bpos::find()
        ->select(['POS_NAME', 'POS_ID'])
        ->indexBy('POS_ID')
        ->column()
    ); ?>

    <?= $form->field($model, 'TOVAR_ID')->dropDownList(\app\models\Tovar::find()
        ->select(['NAME', 'TOVAR_ID'])
        ->indexBy('TOVAR_ID')
        ->column()
    ); ?>

    <?= $form->field($model, 'PRICE_DATE')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Введите дату ...'],
        'value' => date('Y-m-d'),
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'PRICE_VALUE')->textInput() ?>

    <?= $form->field($model, 'ISUSED')->dropDownList(
        \app\models\TovarPrice::$valueYesNo, [
            'prompt' => 'Выберите активность'
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
