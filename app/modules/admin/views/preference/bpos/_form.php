<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Bpos;

/* @var $this yii\web\View */
/* @var $model app\models\Bpos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bpos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'POS_ID')->textInput() ?>

    <?= $form->field($model, 'POS_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADDR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PUBLISHED')->dropDownList(Bpos::$valuePublished) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
        <?= Html::a(Yii::t('app', 'Отменить'), Yii::$app->request->referrer, ['class' => 'btn btn-info'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
