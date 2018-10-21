<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PayCheckIntlTb */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pay-check-intl-tb-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'POS_ID')->textInput() ?>

    <?= $form->field($model, 'CHECKNO')->textInput() ?>

    <?= $form->field($model, 'STRNO')->textInput() ?>

    <?= $form->field($model, 'TOVAR_ID')->textInput() ?>

    <?= $form->field($model, 'KVO')->textInput() ?>

    <?= $form->field($model, 'PRICE')->textInput() ?>

    <?= $form->field($model, 'SUMMA')->textInput() ?>

    <?= $form->field($model, 'PUBLISHED')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ROW_NPP')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
