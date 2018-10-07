<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bpos */

$this->title = $model->POS_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bpos'), 'url' => ['bpos-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bpos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['bpos-update', 'id' => $model->POS_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['bpos-delete', 'id' => $model->POS_ID], [
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
            'POS_NAME',
            'ADDR',
            'PUBLISHED',
        ],
    ]) ?>

</div>
