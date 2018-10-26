<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TovarType */

$this->title = Yii::t('app', 'Добавить тип товара');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Тип товара'), 'url' => ['tovar-type-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tovar-type-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
