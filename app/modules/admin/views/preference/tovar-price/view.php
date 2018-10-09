<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TovarPrice */

$this->title = $model->POS_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Цена товара'), 'url' => ['tovar-price-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tovar-price-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['tovar-price-update', 'POS_ID' => $model->POS_ID, 'TOVAR_ID' => $model->TOVAR_ID, 'PRICE_DATE' => $model->PRICE_DATE], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['tovar-price-delete', 'POS_ID' => $model->POS_ID, 'TOVAR_ID' => $model->TOVAR_ID, 'PRICE_DATE' => $model->PRICE_DATE], [
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
            'TOVAR_ID',
            'PRICE_DATE',
            'PRICE_VALUE',
            'PUBLISHED',
            'ISUSED',
        ],
    ]) ?>

</div>
