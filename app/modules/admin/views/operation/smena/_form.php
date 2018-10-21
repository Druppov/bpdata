<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Smena */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smena-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'POS_ID')->textInput() ?>

    <?= $form->field($model, 'DATEOPEN')->textInput() ?>

    <?= $form->field($model, 'DATECLOSE')->textInput() ?>

    <?= $form->field($model, 'CHIEF')->textInput() ?>

    <?= $form->field($model, 'ZOTCHENO')->textInput() ?>

    <?= $form->field($model, 'PUBLISHED')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
