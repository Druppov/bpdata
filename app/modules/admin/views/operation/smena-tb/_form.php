<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SmenaTb */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smena-tb-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'POS_ID')->textInput() ?>

    <?= $form->field($model, 'SMENA_ID')->textInput() ?>

    <?= $form->field($model, 'PERSON_ID')->textInput() ?>

    <?= $form->field($model, 'TIME_START')->textInput() ?>

    <?= $form->field($model, 'TIME_END')->textInput() ?>

    <?= $form->field($model, 'WORK_ID')->textInput() ?>

    <?= $form->field($model, 'PUBLISHED')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
