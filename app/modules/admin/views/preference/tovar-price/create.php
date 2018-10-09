<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TovarPrice */

$this->title = Yii::t('app', 'Добавить цену товара');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Цена товара'), 'url' => ['tovar-price-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tovar-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
