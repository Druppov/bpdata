<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Work */

$this->title = Yii::t('app', 'Создать тип сотрудника');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Типы сотрудников'), 'url' => ['work-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
