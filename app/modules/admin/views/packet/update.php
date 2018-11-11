<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PacketIn */

$this->title = Yii::t('app', 'Изменить пакет: ' . $model->PACKETFILENAME, [
    'nameAttribute' => '' . $model->PACKETFILENAME,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пакеты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PACKETFILENAME, 'url' => ['view', 'POS_ID' => $model->POS_ID, 'PACKETNO' => $model->PACKETNO]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменить');
?>
<div class="packet-in-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
