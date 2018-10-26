<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TovarType */

$this->title = $model->TYPE_NAME;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Тип товара'), 'url' => ['tovar-type-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tovar-type-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a(Yii::t('app', 'Изменить'), ['tovar-type-update', 'id' => $model->TYPE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['tovar-type-delete', 'id' => $model->TYPE_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Отменить'), Yii::$app->request->referrer, ['class' => 'btn btn-info'])?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'TYPE_ID',
            'TYPE_NAME',
            'SHOWASCATEGORY',
        ],
    ]) ?>

</div>
