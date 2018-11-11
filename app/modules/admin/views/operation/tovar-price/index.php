<?php

use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\TovarPrice;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TovarPriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Отчет `Цена товара`');
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    'tovar.NAME',
    'PRICE_DATE',
    'PRICE_VALUE',
    'ISUSED',
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

<div class="tovar-price-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <? echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
    ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
            '{export}',
            $fullExportMenu,
        ],
        'autoXlFormat'=>true,
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'export'=>[
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK
        ],
        'showPageSummary' => true,
        /*
        'autoXlFormat'=>true,
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'export'=>[
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK
        ],
        //'showPageSummary'=>true,
        'panel'=>[
            'type'=>'primary',
            'heading'=>$this->title
        ],
        */
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'attribute' => 'POS_ID',
                'value' => 'bpos.POS_NAME',
                'filter' => TovarPrice::getBposFilter($searchModel),
            ],
            [
                'attribute' => 'TOVAR_NAME',
                'value' => 'tovar.NAME',
                'label' => Yii::t('app', 'Товар'),
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'PRICE_DATE',
                'value' => 'PRICE_DATE',
                'filterType'=> GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'language'=>'ru',
                    'options' => ['placeholder' => 'Выберите дату'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        //'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                    ]
                ],
                'format' => 'html',
            ],
            [
                'attribute' => 'PRICE_VALUE',
                'format' => ['currency', ''],
                'pageSummary' => true,
            ],
            [
                'attribute' => 'ISUSED',
                'format' => 'raw',
                'value' => function ($model, $index, $widget) {
                    if ($model->ISUSED=='Y') {
                        return '<span class="glyphicon glyphicon-ok text-success"></span>';
                    } else {
                        return '<span class="glyphicon glyphicon-remove text-danger"></span>';
                    }
                },
                'filter' => \app\models\TovarPrice::$valueYesNo,
            ],
        ],
    ]); ?>
</div>
