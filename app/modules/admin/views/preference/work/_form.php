<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Work */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-form">

    <?php $form = ActiveForm::begin(); ?>

    <? echo $form->errorSummary($model);?>

    <?//= $form->field($model, 'WORK_ID')->textInput() ?>

    <?= $form->field($model, 'WORKNAME')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'PUBLISHED')->dropDownList(\app\models\Work::$valuePublished) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Отменить'), Yii::$app->request->referrer, ['class' => 'btn btn-info'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
