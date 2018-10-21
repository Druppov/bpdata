<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Smena */

$this->title = Yii::t('app', 'Create Smena');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Smenas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smena-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
