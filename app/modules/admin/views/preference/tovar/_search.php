<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\TovarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tovar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['tovar-index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?//= $form->field($model, 'TOVAR_ID') ?>

    <?= $form->field($model, 'NAME') ?>

    <?= $form->field($model, 'PRINTNAME') ?>

    <?= $form->field($model, 'TYPE_ID') ?>

    <?= $form->field($model, 'TAX_ID') ?>

    <?php // echo $form->field($model, 'ISACTIVE') ?>

    <?php // echo $form->field($model, 'PUBLISHED') ?>

    <?php // echo $form->field($model, 'FKEY_1C') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
