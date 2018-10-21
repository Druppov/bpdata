<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SmenaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smena-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'POS_ID') ?>

    <?= $form->field($model, 'SMENA_ID') ?>

    <?= $form->field($model, 'DATEOPEN') ?>

    <?= $form->field($model, 'DATECLOSE') ?>

    <?= $form->field($model, 'CHIEF') ?>

    <?php // echo $form->field($model, 'ZOTCHENO') ?>

    <?php // echo $form->field($model, 'PUBLISHED') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
