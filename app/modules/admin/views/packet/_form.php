<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use app\models\Bpos;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\PacketIn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="packet-in-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>

    <?= $form->errorSummary($model); ?>
    <?/*= $form->field($model, 'POS_ID')
            ->dropDownList(Bpos::find()
            ->select(['POS_NAME', 'POS_ID'])
            ->indexBy('POS_ID')
            ->orderBy('POS_NAME')
            ->column()
    );*/ ?>

    <?//= $form->field($model, 'PACKETNO')->textInput() ?>

    <?= $form->field($model, 'PACKETFILENAME')->widget(FileInput::classname(), [
        'language' => 'ru',
        'options' => [
            'accept' => '.zip,.rar',
            'multiple' => true
        ],
        'pluginOptions' => [
            'previewFileType' => 'any',
            //'uploadUrl' => Url::to(['/admin/packet/file-upload']),
            'allowedFileExtensions'=>['zip','rar']
        ]
    ]); ?>

    <?//= $form->field($model, 'DATA')->textInput() ?>

    <? if (!$model->isNewRecord) {
        echo $form->field($model, 'PROCESSED')->dropDownList(\app\models\PacketIn::$valueYesNo);
    }
    ?>
    <?//= $form->field($model, 'PROCESSED')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Отменить'), Yii::$app->request->referrer, ['class' => 'btn btn-info'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
