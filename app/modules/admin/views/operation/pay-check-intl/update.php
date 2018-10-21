<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PayCheckIntlTb */

$this->title = Yii::t('app', 'Update Pay Check Intl Tb: ' . $model->POS_ID, [
    'nameAttribute' => '' . $model->POS_ID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pay Check Intl Tbs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->POS_ID, 'url' => ['view', 'POS_ID' => $model->POS_ID, 'CHECKNO' => $model->CHECKNO, 'STRNO' => $model->STRNO]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pay-check-intl-tb-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
