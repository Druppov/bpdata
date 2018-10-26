<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bpos */

$this->title = $model->POS_NAME;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Точки продаж'), 'url' => ['bpos-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bpos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Изменить'), ['bpos-update', 'id' => $model->POS_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['bpos-delete', 'id' => $model->POS_ID], [
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
            'POS_ID',
            'POS_NAME',
            'ADDR',
            'PUBLISHED',
        ],
    ]) ?>

</div>
