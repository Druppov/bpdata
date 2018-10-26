<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tovar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tovar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'TOVAR_ID')->textInput() ?>

    <?= $form->field($model, 'NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRINTNAME')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'TYPE_ID')->textInput() ?>

    <?//= $form->field($model, 'TAX_ID')->textInput() ?>

    <?= $form->field($model, 'ISACTIVE')->dropDownList(\app\models\Tovar::$valueYesNo) ?>

    <?//= $form->field($model, 'PUBLISHED')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FKEY_1C')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Отменить'), Yii::$app->request->referrer, ['class' => 'btn btn-info'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
