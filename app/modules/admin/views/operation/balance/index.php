<?php

use app\modules\admin\assets\ThemeHelper;
use kop\y2sp\ScrollPager;
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;
use app\models\Balance;
use app\models\Bpos;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\BalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$addTitle = '';
if (!empty($searchModel->POS_ID)) {
    $addTitle .= Bpos::getName($searchModel->POS_ID);
}
if (!empty($searchModel->BALANCEDATE)) {
    if (!empty($addTitle)) {
        $addTitle .= ' : ';
    }
    $addTitle .= $searchModel->BALANCEDATE;
}
if (!empty($addTitle)) {
    $addTitle = ' ('.$addTitle.')';
}
$this->title = Yii::t('app', 'Остатки'.$addTitle);
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    'bpos.POS_NAME',
    'BALANCEDATE',
    'tovar.NAME',
    'AMOUNT',
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

<div class="balance-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <? /*echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
    ]);*/ ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'class' => ScrollPager::className(),
            'container' => '.grid-view tbody',
            'item' => 'tr',
            'paginationSelector' => '.grid-view .pagination',
            'triggerTemplate' => '<tr class="ias-trigger"><td colspan="100%" style="text-align: center"><a style="cursor: pointer">{text}</a></td></tr>',
            'enabledExtensions'  => [
                ScrollPager::EXTENSION_SPINNER,
                //ScrollPager::EXTENSION_NONE_LEFT,
                ScrollPager::EXTENSION_PAGING,
            ],
        ],
        'filterModel' => $searchModel,
        'pjax'=>true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'showPageSummary' => true,
        'panel' => [
            'type' => 'primary',
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
                'filter' => Balance::getBposFilter($searchModel),
                'visible' => empty($searchModel->POS_ID),
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'BALANCEDATE',
                'value' => 'BALANCEDATE',
                'filterType'=> GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'language'=>'ru',
                    'options' => ['placeholder' => 'Укажите дату'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ],
                'format' => 'html',
                'visible' => empty($searchModel->BALANCEDATE),
            ],
            [
                'attribute' => 'TOVAR_NAME',
                'value' => 'tovar.NAME',
                'label' => Yii::t('app', 'Товар')
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'AMOUNT',
                'editableOptions'=>[
                    'formOptions'=>['action' => ['/admin/operation/balance-edit-amount']], // point to the new action
                    'options'=>['pluginOptions'=>['min'=>0, 'max'=>5000]]
                ],
                'hAlign'=>'right',
                'vAlign'=>'middle',
                'width'=>'100px',
                'format'=>['decimal', 2],
            ],
        ],
    ]); ?>
</div>
