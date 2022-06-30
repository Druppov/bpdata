<?php

use app\models\Bpos;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PaycheckSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paycheck-search">

    <?php $form = ActiveForm::begin([
        'action' => ['count-index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'POS_ID')->dropDownList(Bpos::getBposList(), [
        'prompt'=>'Выберите точку продаж',
    ]) ?>

<!--    --><?//= $form->field($model, 'STAMP')->widget(DatePicker::classname(), [
//        'options' => ['placeholder' => 'Введите дату ...'],
//        'value' => date('Y-m-d'),
//        'pluginOptions' => [
//            'autoclose'=>true,
//            'language' => 'ru',
//            'format' => 'dd.mm.yyyy'
//        ]
//    ]); ?>

    <?= $form->field($model, 'DATE_BEGIN')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Введите дату ...'],
        'value' => date('Y-m-d'),
        'pluginOptions' => [
            'autoclose'=>true,
            'language' => 'ru',
//            'format' => 'dd.mm.yyyy'
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'DATE_END')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Введите дату ...'],
        'value' => date('Y-m-d'),
        'pluginOptions' => [
            'autoclose'=>true,
            'language' => 'ru',
//            'format' => 'dd.mm.yyyy'
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'PUBLISHED')->dropDownList(
        \app\modules\admin\models\PaycheckSearch::$valuePublished,
        ['prompt'=>'Все',]
    ); ?>

    <?= $form->field($model, 'RET')->dropDownList(
        [0=>Yii::t('app', 'Продажа'), 1=>Yii::t('app', 'Возврат')],
        ['prompt'=>'Все',]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Найти'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Отмена'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
