<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PayCheckIntlTb */

$this->title = Yii::t('app', 'Внести внутренни расходы');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Внутренние расходы'), 'url' => ['pay-check-intl-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-check-intl-tb-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
