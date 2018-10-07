<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */

$this->title = Yii::t('app', 'Update Personal: ' . $model->PERSON_ID, [
    'nameAttribute' => '' . $model->PERSON_ID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personals'), 'url' => ['personal-index']];
$this->params['breadcrumbs'][] = ['label' => $model->PERSON_ID, 'url' => ['personal-view', 'id' => $model->PERSON_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="personal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
