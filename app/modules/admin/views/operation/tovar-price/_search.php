<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\TovarPriceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tovar-price-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'POS_ID') ?>

    <?= $form->field($model, 'TOVAR_ID') ?>

    <?= $form->field($model, 'PRICE_DATE') ?>

    <?= $form->field($model, 'PRICE_VALUE') ?>

    <?= $form->field($model, 'PUBLISHED') ?>

    <?php // echo $form->field($model, 'ISUSED') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
