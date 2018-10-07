<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\TovarTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tovar-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['tovar-type-index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'TYPE_NAME') ?>

    <?= $form->field($model, 'SHOWASCATEGORY') ?>

    <?= $form->field($model, 'PUBLISHED') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
