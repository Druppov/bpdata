<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PayCheckIntlTb */

$this->title = Yii::t('app', 'Create Pay Check Intl Tb');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pay Check Intl Tbs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-check-intl-tb-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
