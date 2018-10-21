<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PayCheckIntlTb */

$this->title = $model->POS_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pay Check Intl Tbs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-check-intl-tb-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'POS_ID' => $model->POS_ID, 'CHECKNO' => $model->CHECKNO, 'STRNO' => $model->STRNO], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'POS_ID' => $model->POS_ID, 'CHECKNO' => $model->CHECKNO, 'STRNO' => $model->STRNO], [
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
