<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\TovarType;
//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TovarType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tovar-type-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form-tovar-type',
        //'layout' => 'horizontal',
    ]); ?>

    <?//= $form->field($model, 'TYPE_ID')->textInput() ?>

    <?= $form->field($model, 'TYPE_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SHOWASCATEGORY')->dropDownList(TovarType::$valueYesNo); ?>

    <?//= $form->field($model, 'PUBLISHED')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Отменить'), Yii::$app->request->referrer, ['class' => 'btn btn-info'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
