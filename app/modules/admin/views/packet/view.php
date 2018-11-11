<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PacketIn */

$this->title = $model->PACKETFILENAME;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пакеты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packet-in-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a(Yii::t('app', 'Изменить'), ['update', 'POS_ID' => $model->POS_ID, 'PACKETNO' => $model->PACKETNO], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'POS_ID' => $model->POS_ID, 'PACKETNO' => $model->PACKETNO], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'POS_ID',
                'value' => $model->bpos->POS_NAME,
            ],
            'PACKETNO',
            'PACKETFILENAME',
            //'DATA',
            //'PROCESSED',
            [
                'attribute' => 'PROCESSED',
                'value' => \app\models\PacketIn::$valueYesNo[$model->PROCESSED],
            ],
        ],
    ]) ?>

</div>
