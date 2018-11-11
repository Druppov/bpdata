<?php

use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\PayCheckIntlTb;
use app\models\Smena;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PayCheckIntlTbSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Внутренний расход');
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

<?php //$this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
<?//= Html::a(Yii::t('app', 'Добавить внутренний расход'), ['pay-check-intl-create'], ['class' => 'btn btn-sm btn-success']) ?>
<?php //$this->endBlock(); ?>

<div class="pay-check-intl-tb-index">

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
                'filter' => PayCheckIntlTb::getBposFilter($searchModel, 'smena-selector-id'),
            ],
            [
                'attribute' => 'SMENA_ID',
                'label' => Yii::t('app', 'Смена'),
                //'value' => 'smenaData',
                'value' => function($model) {
                    return Smena::getSmenaName($model->POS_ID, $model->payCheckIntl->SMENA_ID);
                    //return $model->smenaData;
                },
                'filter' => Html::activeDropDownList($searchModel, 'SMENA_ID',
                    Smena::getSmenaList($searchModel->POS_ID),
                    [
                        'id'=>'smena-selector-id',
                        'class'=>'form-control',
                        'prompt'=>'Выберите смену',
                        ]
                )
            ],
            [
                'attribute' => 'TOVAR_NAME',
                'value' => 'tovar.NAME',
                'label' => Yii::t('app', 'Товар'),
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
                'filter' => \app\models\PayCheckIntlTb::$valuePublished,
            ],
            */
        ],
    ]); ?>
</div>
