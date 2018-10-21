<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PacketIn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="packet-in-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'POS_ID')->textInput() ?>

    <?= $form->field($model, 'PACKETNO')->textInput() ?>

    <?= $form->field($model, 'PACKETFILENAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATA')->textInput() ?>

    <?= $form->field($model, 'PROCESSED')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
