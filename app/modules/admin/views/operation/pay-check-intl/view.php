<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PayCheckIntlTb */

$this->title = $model->POS_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Внутренние расходы'), 'url' => ['pay-check-intl-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-check-intl-tb-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Изменить'), ['update', 'POS_ID' => $model->POS_ID, 'CHECKNO' => $model->CHECKNO, 'STRNO' => $model->STRNO], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'POS_ID' => $model->POS_ID, 'CHECKNO' => $model->CHECKNO, 'STRNO' => $model->STRNO], [
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
            'POS_ID',
            'CHECKNO',
            'STRNO',
            'TOVAR_ID',
            'KVO',
            'PRICE',
            'SUMMA',
            'PUBLISHED',
            'ROW_NPP',
        ],
    ]) ?>

</div>
