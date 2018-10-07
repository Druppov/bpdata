<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TovarType */

$this->title = Yii::t('app', 'Create Tovar Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tovar Types'), 'url' => ['tovar-type-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tovar-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
