<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TovarType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tovar-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TYPE_ID')->textInput() ?>

    <?= $form->field($model, 'TYPE_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SHOWASCATEGORY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PUBLISHED')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
