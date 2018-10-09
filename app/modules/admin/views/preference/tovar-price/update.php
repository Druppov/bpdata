<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TovarPrice */

$this->title = Yii::t('app', 'Изменить цену товара: ' . $model->POS_ID, [
    'nameAttribute' => '' . $model->POS_ID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Цена товара'), 'url' => ['tovar-price-index']];
$this->params['breadcrumbs'][] = ['label' => $model->POS_ID, 'url' => ['tovar-price-view', 'POS_ID' => $model->POS_ID, 'TOVAR_ID' => $model->TOVAR_ID, 'PRICE_DATE' => $model->PRICE_DATE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>
<div class="tovar-price-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
