<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bpos */

$this->title = Yii::t('app', 'Добавить точку');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Точки продаж'), 'url' => ['bpos-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bpos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
