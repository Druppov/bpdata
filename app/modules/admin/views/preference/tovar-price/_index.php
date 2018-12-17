<?php

use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\dialog\Dialog;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TovarPriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
<?= Html::a("<span class='glyphicon glyphicon-new-window'></span>",
    ['/admin/preference/tovar-price-create', 'POS_ID'=>$model->POS_ID, 'TOVAR_ID'=>$model->TOVAR_ID],
    [
        'value'=>Yii::$app->urlManager->createUrl('/admin/preference/tovar-price-create'),
        //<---- here is where you define the action that handles the ajax request
        'class'=>'add-modal-click grid-action popupModal',
        'data-toggle'=>'tooltip',
        'data-placement'=>'bottom',
        'title'=>'Добавить'
    ]); ?>
<?php $this->endBlock(); ?>
<div class="tovar-price-index">
    <?= GridView::widget([
        'id' => 'grid-tovar-price',
        'pjax' => true,
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'toolbar' => [
            [
                'content'=>
                    Html::a("<span class='glyphicon glyphicon-new-window'></span>",
                        ['/admin/preference/tovar-price-create', 'POS_ID'=>$model->POS_ID, 'TOVAR_ID'=>$model->TOVAR_ID],
                        [
                            'value'=>Yii::$app->urlManager->createUrl('/admin/preference/tovar-price-create'),
                            //<---- here is where you define the action that handles the ajax request
                            'class'=>'add-modal-click grid-action popupModal',
                            'data-toggle'=>'tooltip',
                            'data-placement'=>'bottom',
                            'title'=>'Добавить'
                        ]),
            ],
        ],
        'columns' => [
            //['class' => 'kartik\grid\SerialColumn'],
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
                        'todayHighlight' => true,
                    ]
                ],
                'format' => 'html',
            ],
            /*
            [
                'attribute' => 'PRICE_DATE',
                'value' => 'PRICE_DATE',
                'filter' => \yii\jui\DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'PRICE_DATE',
                    'language' => 'ru',
                    'dateFormat' => 'dd-MM-yyyy',
                ]),
                'format' => 'html',
            ],
            */
            [
                'attribute' => 'PRICE_VALUE',
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

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width'=>'120'],
                'header' => Yii::t('app', 'Действия'),
                'template' => '{update}&nbsp;{add}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    $action = 'tovar-price-'.$action;
                    return Url::to(['preference/'.$action, 'id' => $model->TOVAR_ID]);
                },
                'buttons'=>[
                    /*
                    'update' => function($url,$model,$key){
                        $btn = Html::button("<span class='glyphicon glyphicon-pencil'></span>",[
                            'value'=>Yii::$app->urlManager->createUrl('example/update?id='.$key), //<---- here is where you define the action that handles the ajax request
                            'class'=>'update-modal-click grid-action',
                            'data-toggle'=>'tooltip',
                            'data-placement'=>'bottom',
                            'title'=>'Update'
                        ]);
                        return $btn;
                    },
                    */
                    'update' => function($url,$model,$key){
                        $btn = Html::a("<span class='glyphicon glyphicon-pencil'></span>",
                            ['/admin/preference/tovar-price-update', 'POS_ID'=>$model->POS_ID, 'TOVAR_ID'=>$model->TOVAR_ID, 'PRICE_DATE'=>$model->PRICE_DATE],
                            [
                            'value'=>Yii::$app->urlManager->createUrl(['/admin/preference/tovar-price-update', 'POS_ID'=>$model->POS_ID, 'TOVAR_ID'=>$model->TOVAR_ID, 'PRICE_DATE'=>$model->PRICE_DATE]),
                            //<---- here is where you define the action that handles the ajax request
                            'class'=>'add-modal-click grid-action popupModal',
                            'data-toggle'=>'tooltip',
                            'data-placement'=>'bottom',
                            'title'=>'Изменить'
                            ]);
                        return $btn;
                    },
                    'add' => function($url,$model,$key){
                        $btn = Html::a("<span class='glyphicon glyphicon-new-window'></span>",
                            ['/admin/preference/tovar-price-create', 'POS_ID'=>$model->POS_ID, 'TOVAR_ID'=>$model->TOVAR_ID],
                            [
                            'value'=>Yii::$app->urlManager->createUrl('/admin/preference/tovar-price-create'),
                            //<---- here is where you define the action that handles the ajax request
                            'class'=>'add-modal-click grid-action popupModal',
                            'data-toggle'=>'tooltip',
                            'data-placement'=>'bottom',
                            'title'=>'Добавить'
                            ]);
                        return $btn;
                    }
                ],
            ],
            /*
            [
                'header'=>'Plan Info',
                'value'=> function($data) {
                    return  Html::a(Yii::t('app', ' {modelClass}', [
                        'modelClass' => 'details',
                    ]),
                        ['/admin/preference/tovar-price-update', 'POS_ID'=>$data->POS_ID, 'TOVAR_ID'=>$data->TOVAR_ID, 'PRICE_DATE'=>$data->PRICE_DATE],
                        ['class' => 'btn btn-success popupModal']
                    );
                },
                'format' => 'raw'
            ],
            */
        ]
    ]); ?>
</div>

<?
/*
$script = <<<JS
$('#grid-tovar-price tbody tr').on('click', function() {
    var data = $(this).data();
    console.log(data.key);
    $('#dialog-modal').modal('show');
});
JS;
*/
$script = <<<JS
$('.popupModal').click(function(e) {
     e.preventDefault();
     $('#dialog-modal').modal('show');
     $('#dialog-modal').find('.modal-body').load($(this).attr('href'));
});
JS;
$this->registerJs($script);

echo Dialog::widget();
$js = <<<JS
    krajeeDialog.dialog(
        'This is a <b>custom dialog</b>. The dialog box is <em>draggable</em> by default and <em>closable</em> ' +
        '(try it). Note that the Ok and Cancel buttons will do nothing here until you write the relevant JS code ' +
        'for the buttons within "options". Exit the dialog by clicking the cross icon on the top right.',
        function (result) {alert(result);}
    );
JS;
//$this->registerJs($js);
?>