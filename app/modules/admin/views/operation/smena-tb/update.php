<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SmenaTb */

$this->title = Yii::t('app', 'Update Smena Tb: ' . $model->POS_ID, [
    'nameAttribute' => '' . $model->POS_ID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Smena Tbs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->POS_ID, 'url' => ['view', 'POS_ID' => $model->POS_ID, 'SMENA_ID' => $model->SMENA_ID, 'PERSON_ID' => $model->PERSON_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="smena-tb-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
