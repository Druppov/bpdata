<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Work */

$this->title = $model->WORKNAME;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Тип сотрудников'), 'url' => ['work-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-view">

    <p>
        <?= Html::a(Yii::t('app', 'Изменить'), ['work-update', 'id' => $model->WORK_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['work-delete', 'id' => $model->WORK_ID], [
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
            'WORK_ID',
            'WORKNAME',
            'PUBLISHED',
        ],
    ]) ?>

</div>
