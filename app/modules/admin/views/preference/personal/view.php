<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */

$this->title = $model->PERSON_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personals'), 'url' => ['personal-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['personal-update', 'id' => $model->PERSON_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['personal-delete', 'id' => $model->PERSON_ID], [
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
            'PERSON_ID',
            'FIO',
            'ISACTIVE',
            'PUBLISHED',
        ],
    ]) ?>

</div>
