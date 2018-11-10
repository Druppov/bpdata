<?php

use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\PayCheckTb;
use app\models\Smena;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PayCheckIntlTbSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Чеки');
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    'bpos.POS_NAME',
    'smenaData',
    'tovar.NAME',
    'KVO',
    'PRICE',
    'SUMMA',
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

<div class="pay-check-tb-index">

    <? //echo $fullExportMenu; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'grid-pay-check',
        'filterModel' => $searchModel,
        'pjax'=>true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'showPageSummary' => true,
        'panel' => [
            'type' => 'primary',
            //'heading' => false,
            //'heading'=>$this->title,
        ],
        'toolbar' => [
            //'{export}',
            $fullExportMenu,
        ],
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
                'value' => 'bpos.POS_NAME',
                'filter' => PayCheckTb::getBposFilter($searchModel, 'smena-selector-id'),
                //'group' => true,
            ],
            [
                'attribute' => 'SMENA_ID',
                'label' => Yii::t('app', 'Смена'),
                'value' => function($model) {
                    return Smena::getSmenaName($model->POS_ID, $model->payCheck->SMENA_ID);
                },
                'filter' => Html::activeDropDownList($searchModel, 'SMENA_ID',
                    Smena::getSmenaList($searchModel->POS_ID),
                    [
                        'id'=>'smena-selector-id',
                        'class'=>'form-control',
                        'prompt'=>'Выберите смену',
                        ]
                ),
            ],
            [
                'attribute' => 'TOVAR_NAME',
                'label' => Yii::t('app', 'Товар'),
                'value' => 'tovar.NAME',
            ],
            [
                'attribute' => 'KVO',
            ],
            [
                'attribute' => 'PRICE',
                'format' => ['currency', ''],
            ],
            [
                'attribute' => 'SUMMA',
                'format' => ['currency', ''],
                'pageSummary' => true,
                'pageSummaryFunc' => GridView::F_SUM,
            ],
            /*
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
            */
        ],
    ]); ?>
</div>
