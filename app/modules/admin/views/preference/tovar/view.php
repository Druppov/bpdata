<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tovar */

$this->title = $model->NAME;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Товары'), 'url' => ['tovar-index', 'type'=>$model->TYPE_ID]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tovar-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a(Yii::t('app', 'Изменить'), ['tovar-update', 'id' => $model->TOVAR_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['tovar-delete', 'id' => $model->TOVAR_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Отменить'), Yii::$app->request->referrer, ['class' => 'btn btn-info'])?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'TOVAR_ID',
            'NAME',
            'PRINTNAME',
            'ISACTIVE',
            'FKEY_1C',
        ],
    ]) ?>

</div>
