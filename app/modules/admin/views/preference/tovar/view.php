<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tovar */

$this->title = $model->NAME;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tovars'), 'url' => ['tovar-index', 'type'=>$model->TYPE_ID]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tovar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['tovar-update', 'id' => $model->TOVAR_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['tovar-delete', 'id' => $model->TOVAR_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'TOVAR_ID',
            'NAME',
            'PRINTNAME',
            'TYPE_ID',
            'TAX_ID',
            'ISACTIVE',
            'PUBLISHED',
            'FKEY_1C',
        ],
    ]) ?>

</div>
