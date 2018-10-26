<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Balance */

$this->title = $model->bpos->POS_NAME.'/'.$model->tovar->NAME;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Остатки'), 'url' => ['balance-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Изменить'), ['balance-update', 'POS_ID' => $model->POS_ID, 'BALANCEDATE' => $model->BALANCEDATE, 'TOVAR_ID' => $model->TOVAR_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['balance-delete', 'POS_ID' => $model->POS_ID, 'BALANCEDATE' => $model->BALANCEDATE, 'TOVAR_ID' => $model->TOVAR_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Отменить'), Yii::$app->request->referrer, ['class' => 'btn btn-info'])?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'POS_ID',
            [
                'attribute' => 'POS_ID',
                'value' => $model->bpos->POS_NAME,
            ],
            'BALANCEDATE',
            //'TOVAR_ID',
            [
                'attribute' => 'TOVAR_ID',
                'value' => $model->tovar->NAME,
            ],
            'AMOUNT',
            'PUBLISHED',
        ],
    ]) ?>

</div>
