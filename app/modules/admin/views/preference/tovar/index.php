<?php

use app\modules\admin\models\BposSearch;
use app\modules\admin\models\TovarPriceSearch;
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TovarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tovars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tovar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tovar'), ['tovar-create', 'type'=>$searchModel->TYPE_ID], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model,$key,$index,$column)
                {
                    return GridView::ROW_COLLAPSED;
                },

                'detail' => function ($model,$key,$index,$column) use ($searchModel) {
                    $searchBposModel = new BposSearch();
                    $dataBposProvider = $searchBposModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('bpos/_index',[
                        'searchModel' => $searchBposModel,
                        'dataProvider' => $dataBposProvider,
                        'tovarId' => $model->TOVAR_ID,
                    ]);
                },
            ],

            //'TOVAR_ID',
            'NAME',
            'PRINTNAME',
            'TYPE_ID',
            'TAX_ID',
            //'ISACTIVE',
            //'PUBLISHED',
            //'FKEY_1C',

            //['class' => 'yii\grid\ActionColumn'],
            [
                //'class' => 'yii\grid\ActionColumn',
                'class' => 'kartik\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                    $action = 'tovar-'.$action;
                    return Url::to(['preference/'.$action, 'id' => $model->TOVAR_ID]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
