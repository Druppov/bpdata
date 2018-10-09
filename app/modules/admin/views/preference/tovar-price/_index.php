<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\datecontrol\DateControl;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TovarPriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Цены');
?>
<div class="tovar-price-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tovar Price'), ['tovar-price-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'PRICE_DATE',
                'value' => 'PRICE_DATE',
                /*
                'format' => 'raw',
                'filter' => DateControl::widget([
                    'model' => $searchModel,
                    'attribute' => 'PRICE_DATE',
                    'name'=>'PRICE_DATE',
                    'value'=>time(),
                    'type'=>DateControl::FORMAT_DATE,
                    'autoWidget'=>false,
                    'displayFormat' => 'php:D, d-M-Y H:i:s A',
                    'saveFormat' => 'php:U'
                ])
                */

                /*
                'class' => 'kartik\grid\DataColumn',
                'options' => [
                    'format' => 'YYYY-MM-DD',
                ],
                'format' => 'html',
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' => ([
                    'attribute' => 'only_date',
                    'presetDropdown' => true,
                    'convertFormat' => false,
                    'pluginOptions' => [
                        'separator' => ' - ',
                        'format' => 'YYYY-MM-DD',
                        'locale' => [
                            'format' => 'YYYY-MM-DD'
                        ],
                    ],
                    'pluginEvents' => [
                        "apply.daterangepicker" => "function() { apply_filter('only_date') }",
                    ],
                ])
                */
                'filter' => \yii\jui\DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'PRICE_DATE',
                    'language' => 'ru',
                    'dateFormat' => 'dd-MM-yyyy',
                ]),
                'format' => 'html',
            ],
            'PRICE_VALUE',
            'PUBLISHED',
            'ISUSED',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
