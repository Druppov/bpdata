<?php

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
    <?//= $form->field($model, 'POS_ID') ?>

    <?//= $form->field($model, 'TOVAR_ID') ?>

    <?//= $form->field($model, 'PRICE_DATE') ?>

    <?//= $form->field($model, 'PRICE_VALUE') ?>

    <?//= $form->field($model, 'PUBLISHED') ?>

    <?php // echo $form->field($model, 'ISUSED') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Применить'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Отмена'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
