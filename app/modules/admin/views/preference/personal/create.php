<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Personal */

$this->title = Yii::t('app', 'Create Personal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personals'), 'url' => ['personal-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
