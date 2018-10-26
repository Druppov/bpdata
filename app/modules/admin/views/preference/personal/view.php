<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */

$this->title = $model->FIO;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сотрудники'), 'url' => ['personal-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Изменить'), ['personal-update', 'id' => $model->PERSON_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['personal-delete', 'id' => $model->PERSON_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Отменить'), Yii::$app->request->referrer, ['class' => 'btn btn-info'])?>
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
