<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PayCheckIntlTbSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pay-check-intl-tb-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'POS_ID') ?>

    <?= $form->field($model, 'CHECKNO') ?>

    <?= $form->field($model, 'STRNO') ?>

    <?= $form->field($model, 'TOVAR_ID') ?>

    <?= $form->field($model, 'KVO') ?>

    <?php // echo $form->field($model, 'PRICE') ?>

    <?php // echo $form->field($model, 'SUMMA') ?>

    <?php // echo $form->field($model, 'PUBLISHED') ?>

    <?php // echo $form->field($model, 'ROW_NPP') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
