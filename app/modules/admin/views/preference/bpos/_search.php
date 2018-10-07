<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BposSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bpos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['bpos-index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'POS_NAME') ?>

    <?= $form->field($model, 'ADDR') ?>

    <?= $form->field($model, 'PUBLISHED') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
