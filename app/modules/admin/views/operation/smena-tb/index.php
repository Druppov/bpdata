<?php

use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\SmenaTb;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SmenaTbSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Смена');
$this->params['breadcrumbs'][] = $this->title;

$gridColumns1 = [
    'personal.FIO',
    'work.WORKNAME',
    'PUBLISHED'
];
$gridColumns2 = [
    'tovar.NAME',
    'KVO',
    'SUMMA',
    'PUBLISHED'
];
$fullExportMenu2 = ExportMenu::widget([
    'dataProvider' => $dataPayCheckTbProvider,
    'columns' => $gridColumns2,
    'target' => ExportMenu::TARGET_BLANK,
    'showConfirmAlert' => false,
    'pjaxContainerId' => 'kv-pjax-container',
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

$gridColumns3 = [
    'tovar.NAME',
    'PUBLISHED'
];
$fullExportMenu3 = ExportMenu::widget([
    'dataProvider' => $dataPayCheckTbRetProvider,
    'columns' => $gridColumns3,
    'target' => ExportMenu::TARGET_BLANK,
    'showConfirmAlert' => false,
    'pjaxContainerId' => 'kv-pjax-container',
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

$gridColumns4 = [
    'payCheckIntl.rashodType.RASHODNAME',
    'payCheckIntl.personal.FIO',
    'KVO',
    'SUMMA',
    'PUBLISHED'
];
$fullExportMenu4 = ExportMenu::widget([
    'dataProvider' => $dataPayCheckIntlTbProvider,
    'columns' => $gridColumns4,
    'target' => ExportMenu::TARGET_BLANK,
    'showConfirmAlert' => false,
    'pjaxContainerId' => 'kv-pjax-container',
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

<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
<?= Html::a(Yii::t('app', 'Добавить смену'), ['smena-tb-create'], ['class' => 'btn btn-sm btn-success']) ?>
<?php $this->endBlock(); ?>

<div class="smena-tb-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <? echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns1,
    ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'pjax'=>true,
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'PERSON_ID',
                'value' => 'personal.FIO',
            ],
            'TIME_START',
            'TIME_END',
            [
                'attribute' => 'WORK_ID',
                'value' => 'work.WORKNAME',
            ],
            /*
            [
                'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'PUBLISHED',
                'value' => 'PUBLISHED',
                'trueLabel' => SmenaTb::$valuePublished['P'],
                'falseLabel' => SmenaTb::$valuePublished['U'],
                'filter' => Html::activeDropDownList($searchModel, 'PUBLISHED', SmenaTb::$valuePublished,['class'=>'form-control','prompt' => 'Публикация']),
            ],
            */
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <? if (isset($dataPayCheckTbRetProvider)) {
        /*
        echo ExportMenu::widget([
            'dataProvider' => $dataPayCheckTbProvider,
            'columns' => $gridColumns2,
        ]);
        */
    }
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataPayCheckTbProvider,
        'showFooter' => true,
        'striped' => true,
        'hover' => true,
        'pjax'=>true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'showPageSummary' => true,
        'panel' => [
            'type' => 'primary',
            'heading'=>Yii::t('app', 'Продажи по смене'),
            //'heading' => false,
            //'heading'=>$this->title,
        ],
        'toolbar' => [
            //'{export}',
            $fullExportMenu2,
        ],
        /*
        'autoXlFormat'=>true,
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'export'=>[
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK
        ],
        'panel'=>[
            'heading'=>Yii::t('app', 'Продажи по смене'),
            'type'=>'primary'
        ],
        */
        'columns' => [
            [
                'attribute' => 'TOVAR_ID',
                'value' => 'tovar.NAME',
                'group' => true,
            ],
            [
                'attribute' => 'KVO',
                'pageSummary' => true,
            ],
            [
                'attribute' => 'SUMMA',
                'format' => ['currency', ''],
                'pageSummary' => true,
            ],
            /*
            [
                'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'PUBLISHED',
                'value' => 'PUBLISHED',
                'trueLabel' => SmenaTb::$valuePublished['P'],
                'falseLabel' => SmenaTb::$valuePublished['U'],
                'filter' => Html::activeDropDownList($searchModel, 'PUBLISHED', SmenaTb::$valuePublished,['class'=>'form-control','prompt' => 'Публикация']),
            ],
            */
        ],
    ]); ?>

    <?
    /*echo ExportMenu::widget([
        'dataProvider' => $dataPayCheckTbRetProvider,
        'columns' => $gridColumns3,
    ]);*/
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataPayCheckTbRetProvider,
        'showFooter' => true,
        'striped' => true,
        'hover' => true,
        'pjax'=>true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'showPageSummary' => true,
        'panel' => [
            'type' => 'primary',
            'heading'=>Yii::t('app', 'Возврат')
            //'heading' => false,
            //'heading'=>$this->title,
        ],
        'toolbar' => [
            //'{export}',
            $fullExportMenu2,
        ],
        /*
        'autoXlFormat'=>true,
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'export'=>[
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK
        ],
        'pjax'=>true,
        'panel'=>[
            'type'=>'primary',
            'heading'=>Yii::t('app', 'Возврат')
        ],
        */
        'columns' => [
            [
                'attribute' => 'TOVAR_ID',
                'value' => 'tovar.NAME',
            ],
            [
                'attribute' => 'KVO',
                'pageSummary' => true,
            ],
            [
                'attribute' => 'SUMMA',
                'format' => ['currency', ''],
                'pageSummary' => true,
            ],
            /*
            [
                'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'PUBLISHED',
                'value' => 'PUBLISHED',
                'trueLabel' => SmenaTb::$valuePublished['P'],
                'falseLabel' => SmenaTb::$valuePublished['U'],
                'filter' => Html::activeDropDownList($searchModel, 'PUBLISHED', SmenaTb::$valuePublished,['class'=>'form-control','prompt' => 'Публикация']),
            ],
            */
        ],
    ]); ?>

    <?
    /*echo ExportMenu::widget([
        'dataProvider' => $dataPayCheckIntlTbProvider,
        'columns' => $gridColumns4,
    ]);*/
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataPayCheckIntlTbProvider,
        'showFooter' => true,
        'striped' => true,
        'hover' => true,
        'pjax'=>true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'showPageSummary' => true,
        'panel' => [
            'type' => 'primary',
            'heading'=>Yii::t('app', 'Прочий расход'),
        ],
        'toolbar' => [
            //'{export}',
            $fullExportMenu4,
        ],
        /*
        'autoXlFormat'=>true,
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'export'=>[
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK
        ],
        'pjax'=>true,
        'panel'=>[
            'type'=>'primary',
            'heading'=>Yii::t('app', 'Прочий расход')
        ],
        */
        'columns' => [
            [
                'attribute' => 'RASHOD_ID',
                'value' => 'payCheckIntl.rashodType.RASHODNAME',
                'label' => Yii::t('app', 'Тип расхода'),
            ],
            [
                'attribute' => 'PERSON_ID',
                'value' => 'payCheckIntl.personal.FIO',
                'label' => Yii::t('app', 'ФИО'),
            ],
            [
                'attribute' => 'TOVAR_ID',
                'value' => 'tovar.NAME',
            ],
            'KVO',
            [
                'attribute' => 'SUMMA',
                'format' => ['currency', ''],
                'pageSummary' => true,
            ],
        ],
    ]); ?>

</div>
