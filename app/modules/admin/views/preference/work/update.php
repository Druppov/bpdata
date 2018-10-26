<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Work */

$this->title = Yii::t('app', 'Изменить тип сотрудника: ' . $model->WORKNAME, [
    'nameAttribute' => '' . $model->WORKNAME,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Типы сотрудников'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->WORKNAME, 'url' => ['work-view', 'id' => $model->WORK_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменить');
?>
<div class="work-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
