<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Bpos;
use app\models\Smena;
use app\models\SmenaTb;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SmenaTbSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smena-tb-search">

    <?php $form = ActiveForm::begin([
        'action' => ['smena-tb-index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'POS_ID')->dropDownList(
        //Bpos::find()->select(['POS_NAME', 'POS_ID'])->indexBy('POS_ID')->column(),
        Bpos::getBposList(),
        [
            'id' => 'smenatbsearch-pos-id',
            'prompt'=>'Выберите точку продаж',
            'onchange'=>'
				$.post( "'.Yii::$app->urlManager->createUrl('admin/operation/smena-lists?pos_id=').'"+$(this).val(), function( data ) {
				  $( "select#smenatbsearch-smena-id" ).html( data );
				});
			'
        ]
    ); ?>

    <?= $form->field($model, 'SMENA_ID')->dropDownList(Smena::getSmenaList($model->POS_ID),
        [
            'id'=>'smenatbsearch-smena-id',
            'prompt'=>'Выберите смену',
        ]
    ); ?>

    <?php // echo $form->field($model, 'PERSON_ID') ?>

    <?php // echo $form->field($model, 'TIME_START') ?>

    <?php // echo $form->field($model, 'TIME_END') ?>

    <?php // echo $form->field($model, 'WORK_ID') ?>

    <?= $form->field($model, 'PUBLISHED')->dropDownList(
            SmenaTb::$valuePublished,
            ['prompt'=>'Все',]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Найти'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Отмена'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
