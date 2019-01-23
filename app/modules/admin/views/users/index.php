<?php

use app\models\User;
use app\modules\admin\widgets\LinkedColumn;
use yii\helpers\Html;
use app\modules\admin\assets\ThemeHelper;
use app\modules\admin\widgets\BoxGridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Сотрудники';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
	<?= Html::a('Добавить сотрудника', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
<?php $this->endBlock(); ?>

<div class="user-index">

	<?= BoxGridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel'  => $searchModel,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],
			[
				'class' => LinkedColumn::class,
				'header' => 'Name',
				'attribute' => 'full_name',
				'value' => 'fullName',
			],
			'username',
			'email',
			array(
				'attribute' => 'status',
				'value' => 'statusAlias',
				'filter' => Html::activeDropDownList(
					$searchModel,
					'status',
					User::getStatusesList(),
					['prompt' => 'Все', 'class' => 'form-control']
				),
			),
			'created_at:date:Registered',
			// 'updated_at',
		],
	]); ?>

</div>