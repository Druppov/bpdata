<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SmenaTb */

$this->title = Yii::t('app', 'Create Smena Tb');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Smena Tbs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smena-tb-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
