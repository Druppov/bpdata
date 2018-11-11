<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PacketIn */

$this->title = Yii::t('app', 'Загрузить пакет');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пакеты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packet-in-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
