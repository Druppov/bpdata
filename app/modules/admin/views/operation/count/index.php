<?php

use kartik\export\ExportMenu;
use kop\y2sp\ScrollPager;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PaycheckSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Количество чеков');
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    'bpos.POS_NAME',
    'CNT',
    'SUMMA',
    'RET',
    'PUBLISHED'
];
$fullExportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'target' => ExportMenu::TARGET_BLANK,
    'showConfirmAlert' => false,
    //'pjaxContainerId' => 'kv-pjax-container',
    'exportContainer' => [
        'class' => 'btn-group mr-2'
    ],
    'dropdownOptions' => [
        'label' => 'Экспорт',
        'class' => 'btn btn-secondary',
        'itemsBefore' => [
            '<div class="dropdown-header">Все данные</div>',
        ],
    ],
]);
?>

<div class="paycheck-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'pager' => [
//            'class' => ScrollPager::className(),
//            'container' => '.grid-view tbody',
//            'item' => 'tr',
//            'paginationSelector' => '.grid-view .pagination',
//            'triggerTemplate' => '<tr class="ias-trigger"><td colspan="100%" style="text-align: center"><a style="cursor: pointer">{text}</a></td></tr>',
//            'enabledExtensions'  => [
//                ScrollPager::EXTENSION_SPINNER,
//                ScrollPager::EXTENSION_PAGING,
//            ],
//        ],
//        'filterModel' => $searchModel,
        'pjax'=>true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'showPageSummary' => true,
        'panel' => [
            'type' => 'primary',
        ],
        'toolbar' => [
            $fullExportMenu,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'POS_ID',
                'value' => 'bpos.POS_NAME'
            ],
            [
                'attribute' => 'CNT',
                'value' => 'CNT',
                'headerOptions'=>['style'=>'color:#3c8dbc'],
            ],
            'SUMMA',
            'RET',
//            'STAMP',
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
                'filter' => \app\models\PayCheck::$valuePublished,
            ],
        ],
    ]); ?>
</div>
