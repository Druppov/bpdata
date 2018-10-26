<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Balance */

$this->title = Yii::t('app', 'Изменить остатки: ' . $model->bpos->POS_NAME, [
    'nameAttribute' => '' . $model->bpos->POS_NAME.'/'.$model->tovar->NAME,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Balances'), 'url' => ['balance-index']];
$this->params['breadcrumbs'][] = ['label' => $model->POS_ID, 'url' => ['balance-view', 'POS_ID' => $model->POS_ID, 'BALANCEDATE' => $model->BALANCEDATE, 'TOVAR_ID' => $model->TOVAR_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменить');
?>
<div class="balance-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
