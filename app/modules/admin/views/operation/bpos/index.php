<?php

use app\models\Bpos;
use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\BposSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Точки продаж');
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    'POS_ID',
    'POS_NAME',
    'ADDR',
    'PUBLISHED',
];
?>

<div class="bpos-index">
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <? echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
    ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        /*
        'autoXlFormat'=>true,
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'export'=>[
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK
        ],
        'panel'=>[
            'type'=>'primary',
            'heading'=>$this->title
        ],
        */
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
                    if ($model->PUBLISHED==Bpos::$valuePublished) {
                        return '<span class="glyphicon glyphicon-ok text-success"></span>';
                    } else {
                        return '<span class="glyphicon glyphicon-remove text-danger"></span>';
                    }
                },
                'filter' => Bpos::$valuePublished,
            ],
        ],

    ]); ?>
</div>
