<?php

use app\modules\admin\models\TovarPriceSearch;
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\BposSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="bpos-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            [
                'attribute' => 'POS_ID',
                'headerOptions' => ['width'=>'80'],
            ],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model,$key,$index,$column)
                {
                    return GridView::ROW_COLLAPSED;
                },

                'detail' => function ($modelTovarPrice,$key,$index,$column) use ($model, $tovarId) {
                    $searchTovarPriceModel = new TovarPriceSearch();
                    $searchTovarPriceModel->POS_ID = $modelTovarPrice->POS_ID;
                    $searchTovarPriceModel->TOVAR_ID = $tovarId;
                    $dataTovarPriceProvider = $searchTovarPriceModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('tovar-price/_index',[
                        'searchModel' => $searchTovarPriceModel,
                        'dataProvider' => $dataTovarPriceProvider,
                    ]);
                },
            ],
            'POS_NAME',
            'ADDR',
        ],

    ]); ?>
</div>
