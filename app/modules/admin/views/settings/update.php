<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */

$this->title = 'Обновить параметр: ' . $model->section_name;
$this->params['breadcrumbs'][] = ['label' => 'Настройки системы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->section_name, 'url' => ['view', 'section_name' => $model->section_name, 'key' => $model->key]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
