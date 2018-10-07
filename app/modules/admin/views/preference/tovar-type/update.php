<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TovarType */

$this->title = Yii::t('app', 'Update Tovar Type: ' . $model->TYPE_ID, [
    'nameAttribute' => '' . $model->TYPE_ID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tovar Types'), 'url' => ['tovar-type-index']];
$this->params['breadcrumbs'][] = ['label' => $model->TYPE_ID, 'url' => ['tovar-type-view', 'id' => $model->TYPE_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tovar-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
