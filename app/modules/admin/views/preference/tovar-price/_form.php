<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TovarPrice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tovar-price-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'POS_ID')->textInput() ?>

    <?= $form->field($model, 'TOVAR_ID')->textInput() ?>

    <?= $form->field($model, 'PRICE_DATE')->textInput() ?>

    <?= $form->field($model, 'PRICE_VALUE')->textInput() ?>

    <?= $form->field($model, 'PUBLISHED')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ISUSED')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
