<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */

$this->title = Yii::t('app', 'Изменить сотрудника: ' . $model->FIO, [
    'nameAttribute' => '' . $model->FIO,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сотрудники'), 'url' => ['personal-index']];
$this->params['breadcrumbs'][] = ['label' => $model->FIO, 'url' => ['personal-view', 'id' => $model->PERSON_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменить');
?>
<div class="personal-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
