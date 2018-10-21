<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SmenaTb */

$this->title = $model->POS_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Smena Tbs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smena-tb-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'POS_ID' => $model->POS_ID, 'SMENA_ID' => $model->SMENA_ID, 'PERSON_ID' => $model->PERSON_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'POS_ID' => $model->POS_ID, 'SMENA_ID' => $model->SMENA_ID, 'PERSON_ID' => $model->PERSON_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'POS_ID',
            'SMENA_ID',
            'PERSON_ID',
            'TIME_START',
            'TIME_END',
            'WORK_ID',
            'PUBLISHED',
        ],
    ]) ?>

</div>
