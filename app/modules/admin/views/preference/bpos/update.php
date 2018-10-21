<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bpos */

$this->title = Yii::t('app', 'Изменить точку: ' . $model->POS_NAME, [
    'nameAttribute' => '' . $model->POS_ID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Точки продаж'), 'url' => ['bpos-index']];
$this->params['breadcrumbs'][] = ['label' => $model->POS_NAME, 'url' => ['bpos-view', 'id' => $model->POS_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменить');
?>
<div class="bpos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
