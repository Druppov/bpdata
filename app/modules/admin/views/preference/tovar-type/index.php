<?php

use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\models\TovarType;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TovarTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Тип товара');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
<?= Html::a(Yii::t('app', 'Добавить тип товара'), ['tovar-type-create'], ['class' => 'btn btn-sm btn-success']) ?>
<?php $this->endBlock(); ?>

<div class="tovar-type-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?//php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'TYPE_ID',
                'headerOptions' => ['width'=>'80'],
            ],
            'TYPE_NAME',
            [
                //'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'SHOWASCATEGORY',
                //'value' => 'SHOWASCATEGORY',
                'format' => 'raw',
                'value' => function ($model, $index, $widget) {
                    if ($model->SHOWASCATEGORY=='Y') {
                        return '<span class="glyphicon glyphicon-ok text-success"></span>';
                    } else {
                        return '<span class="glyphicon glyphicon-remove text-danger"></span>';
                    }
                },
                //'trueLabel' => TovarType::$valueYesNo['Y'],
                //'falseLabel' => TovarType::$valueYesNo['N'],
                'filter' => TovarType::$valueYesNo,
            ],
            array(
                'attribute' => 'PUBLISHED',
                'format' => 'raw',
                'value' => function ($model, $index, $widget) {
                    if ($model->PUBLISHED==TovarType::$valuePublished) {
                        return '<span class="glyphicon glyphicon-ok text-success"></span>';
                    } else {
                        return '<span class="glyphicon glyphicon-remove text-danger"></span>';
                    }
                },
                'filter' => TovarType::$valuePublished,
            ),

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width'=>'120'],
                'header' => Yii::t('app', 'Действия'),
                'urlCreator' => function ($action, $model, $key, $index) {
                    $action = 'tovar-type-'.$action;
                    return Url::to(['preference/'.$action, 'id' => $model->TYPE_ID]);
                }
            ],
        ],
    ]); ?>
    <?//php Pjax::end(); ?>
</div>
