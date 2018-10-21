<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PacketIn */

$this->title = Yii::t('app', 'Create Packet In');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packet Ins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packet-in-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
