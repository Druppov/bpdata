<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Bpos;
use app\models\Tovar;

/* @var $this yii\web\View */
/* @var $model app\models\Balance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="balance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'POS_ID')->dropDownList(
        Bpos::find()->select(['POS_NAME','POS_ID'])->indexBy('POS_ID')->column(),
        [
            'prompt'=>'Выберите торговую точку',
        ]
    ); ?>

    <?= $form->field($model, 'BALANCEDATE')->textInput() ?>

    <?= $form->field($model, 'TOVAR_ID')->dropDownList(
        Tovar::find()->select(['NAME','TOVAR_ID'])->indexBy('TOVAR_ID')->column(),
        [
            'prompt'=>'Выберите товар',
        ]
    ); ?>

    <?= $form->field($model, 'AMOUNT')->textInput() ?>

    <?= $form->field($model, 'PUBLISHED')->dropDownList(\app\models\Balance::$valuePublished, ['prompt'=>'Выберите видимость']); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        <? //Yii::$app->request->referrer ?: Yii::$app->homeUrl ?>
        <?= Html::a(Yii::t('app', 'Отменить'), ['balance-index'], ['class' => 'btn btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
