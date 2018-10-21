<?php

use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\TovarPrice;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TovarPriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Цена товара');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
<?= Html::a(Yii::t('app', 'Добавить цену товара'), ['tovar-price-create'], ['class' => 'btn btn-sm btn-success']) ?>
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
                'attribute' => 'TOVAR_ID',
                'value' => 'tovar.NAME'
            ],
            //'PRICE_DATE',
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'PRICE_DATE',
                'value' => 'PRICE_DATE',
                'filterType'=> GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'language'=>'ru',
                    'options' => ['placeholder' => 'Select date'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ],
                //'group' => true,
                'format' => 'html',
            ],
            'PRICE_VALUE',
            /*
            [
                'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'PUBLISHED',
                'value' => 'PUBLISHED',
                'trueLabel' => TovarPrice::$valuePublished['P'],
                'falseLabel' => TovarPrice::$valuePublished['U'],
                'filter' => Html::activeDropDownList($searchModel, 'PUBLISHED', TovarPrice::$valuePublished,['class'=>'form-control','prompt' => 'Публикация']),
            ],
            */
            [
                'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'ISUSED',
                'value' => 'ISUSED',
                'trueLabel' => TovarPrice::$valueIsUsed['Y'],
                'falseLabel' => TovarPrice::$valueIsUsed['N'],
                'filter' => Html::activeDropDownList($searchModel, 'ISUSED', TovarPrice::$valueIsUsed,['class'=>'form-control','prompt' => 'Используется']),
            ],

            //['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
    <?//php Pjax::end(); ?>
</div>
