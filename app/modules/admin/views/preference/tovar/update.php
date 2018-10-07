<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tovar */

$this->title = Yii::t('app', 'Update Tovar: ' . $model->NAME, [
    'nameAttribute' => '' . $model->NAME,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tovars'), 'url' => ['tovar-index', 'type'=>$model->TYPE_ID]];
$this->params['breadcrumbs'][] = ['label' => $model->NAME, 'url' => ['tovar-view', 'id' => $model->TOVAR_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tovar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
