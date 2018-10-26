<?php

use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\Bpos;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\BposSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Точки продаж');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
    <?= Html::a(Yii::t('app', 'Добавить точку'), ['bpos-create'], ['class' => 'btn btn-sm btn-success']) ?>
<?php $this->endBlock(); ?>

<div class="bpos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'POS_ID',
                'headerOptions' => ['width'=>'80'],
            ],
            'POS_NAME',
            'ADDR',
            [
                'attribute' => 'PUBLISHED',
                'format' => 'raw',
                'value' => function ($model, $index, $widget) {
                    if ($model->PUBLISHED=='P') {
                        return '<span class="glyphicon glyphicon-ok text-success"></span>';
                    } else {
                        return '<span class="glyphicon glyphicon-remove text-danger"></span>';
                    }
                },
                'filter' => \app\models\Bpos::$valuePublished,
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width'=>'120'],
                'header' => Yii::t('app', 'Действия'),
                'urlCreator' => function ($action, $model, $key, $index) {
                    $action = 'bpos-'.$action;
                    return Url::to(['preference/'.$action, 'id' => $model->POS_ID]);
                }
            ],
        ],

    ]); ?>
    <?php Pjax::end(); ?>
</div>
