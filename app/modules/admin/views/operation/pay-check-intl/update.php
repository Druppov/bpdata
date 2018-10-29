<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PayCheckIntlTb */

$this->title = Yii::t('app', 'Изменить внутренни расходы: ' . $model->POS_ID, [
    'nameAttribute' => '' . $model->POS_ID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Внутренние расходы'), 'url' => ['pay-check-intl-index']];
$this->params['breadcrumbs'][] = ['label' => $model->POS_ID, 'url' => ['view', 'POS_ID' => $model->POS_ID, 'CHECKNO' => $model->CHECKNO, 'STRNO' => $model->STRNO]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменить');
?>
<div class="pay-check-intl-tb-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
