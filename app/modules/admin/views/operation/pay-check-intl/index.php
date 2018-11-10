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
            ['class' => 'yii\grid\SerialColumn'],

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
            //'CHECKNO',
            //'STRNO',
            [
                'attribute' => 'TOVAR_NAME',
                'value' => 'tovar.NAME',
                'label' => Yii::t('app', 'Товар'),
            ],
            'KVO',
            [
                'attribute' => 'PRICE',
                'format' => ['currency', ''],
            ],
            [
                'attribute' => 'SUMMA',
                'format' => ['currency', ''],
            ],
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
        ],
    ]); ?>
</div>
