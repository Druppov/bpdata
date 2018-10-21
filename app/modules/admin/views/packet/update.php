<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PacketIn */

$this->title = Yii::t('app', 'Update Packet In: ' . $model->POS_ID, [
    'nameAttribute' => '' . $model->POS_ID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packet Ins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->POS_ID, 'url' => ['view', 'POS_ID' => $model->POS_ID, 'PACKETNO' => $model->PACKETNO]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="packet-in-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
