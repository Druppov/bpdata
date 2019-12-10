<?php

use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\models\TovarPrice;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TovarPriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Цена товара');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
<?= Html::a(Yii::t('app', 'Добавить цену товара'), ['tovar-price-create', 'TOVAR_ID'=>$searchModel->TOVAR_ID], ['class' => 'btn btn-sm btn-success']) ?>
<?php $this->endBlock(); ?>

<div class="tovar-price-index">

    <h1><?//= Html::encode($this->title) ?></h1>
    <?//php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'autoXlFormat'=>true,
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'export'=>[
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK
        ],
        'pjax'=>true,
        //'showPageSummary'=>true,
        'panel'=>[
            'type'=>'primary',
            'heading'=>$this->title
        ],
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
            //'PRICE_DATE',
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
                //'group' => true,
                'format' => 'html',
            ],
            'PRICE_VALUE',
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
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width'=>'120'],
                'header' => Yii::t('app', 'Действия'),
                'urlCreator' => function ($action, $model, $key, $index) {
                    $action = 'tovar-price-'.$action;
                    return Url::to(['preference/'.$action, 'POS_ID'=>$model->POS_ID, 'TOVAR_ID'=>$model->TOVAR_ID, 'PRICE_DATE'=>$model->PRICE_DATE]);
                }
            ],
        ],
    ]); ?>
    <?//php Pjax::end(); ?>
</div>
