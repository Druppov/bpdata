<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TovarType */

$this->title = Yii::t('app', 'Изменить тип товара: ' . $model->TYPE_NAME, [
    'nameAttribute' => '' . $model->TYPE_NAME,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Тип товара'), 'url' => ['tovar-type-index']];
$this->params['breadcrumbs'][] = ['label' => $model->TYPE_NAME, 'url' => ['tovar-type-view', 'id' => $model->TYPE_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменить');
?>
<div class="tovar-type-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
