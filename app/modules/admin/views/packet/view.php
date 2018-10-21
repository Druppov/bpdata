<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PacketIn */

$this->title = $model->POS_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packet Ins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packet-in-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'POS_ID' => $model->POS_ID, 'PACKETNO' => $model->PACKETNO], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'POS_ID' => $model->POS_ID, 'PACKETNO' => $model->PACKETNO], [
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
            'PACKETNO',
            'PACKETFILENAME',
            'DATA',
            'PROCESSED',
        ],
    ]) ?>

</div>
