<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\admin\forms\UserForm */

$this->title                   = 'Добавить сотрудника';
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['heading']       = 'Сотрудники';
$this->params['subheading']    = $this->title;
?>
<div class="user-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
