<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PayCheckIntlTb */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pay-check-intl-tb-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'POS_ID')->dropDownList(\app\models\Bpos::find()
        ->select(['POS_NAME', 'POS_ID'])
        ->indexBy('POS_ID')
        ->orderBy('POS_NAME')
        ->column(), [
            'prompt' => 'Выберите точку продаж'
        ]
    ); ?>

    <?= $form->field($model, 'CHECKNO')->textInput() ?>

    <?= $form->field($model, 'STRNO')->textInput() ?>

    <?= $form->field($model, 'TOVAR_ID')->dropDownList(\app\models\Tovar::find()
        ->select(['NAME', 'TOVAR_ID'])
        ->indexBy('TOVAR_ID')
        ->orderBy('NAME')
        ->column(), [
            'prompt' => 'Выберите товар'
        ]
    ); ?>

    <?= $form->field($model, 'KVO')->textInput() ?>

    <?= $form->field($model, 'PRICE')->textInput() ?>

    <?//= $form->field($model, 'SUMMA')->textInput() ?>

    <?= $form->field($model, 'PUBLISHED')->dropDownList(\app\models\Tovar::$valuePublished, [
        'prompt' => 'Выберите области видимости'
    ]) ?>

    <?= $form->field($model, 'ROW_NPP')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Отменить'), Yii::$app->request->referrer, ['class' => 'btn btn-info'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
