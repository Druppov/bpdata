<?php

use app\modules\admin\assets\ThemeHelper;
use app\modules\admin\models\BposSearch;
use app\modules\admin\models\TovarPriceSearch;
use app\models\TovarType;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TovarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Товары и цены');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
<?= Html::a(Yii::t('app', 'Добавить товар'), ['tovar-create', 'type'=>$searchModel->TYPE_ID], ['class' => 'btn btn-sm btn-success']) ?>
<?php $this->endBlock(); ?>

<div class="tovar-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?//php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
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

            [
                'attribute' => 'TOVAR_ID',
                'headerOptions' => ['width'=>80],
            ],
            'NAME',
            'PRINTNAME',
            [
                'attribute' => 'ISACTIVE',
                'format' => 'raw',
                'value' => function ($model, $index, $widget) {
                    if ($model->ISACTIVE=='Y') {
                        return '<span class="glyphicon glyphicon-ok text-success"></span>';
                    } else {
                        return '<span class="glyphicon glyphicon-remove text-danger"></span>';
                    }
                },
                'filter' => \app\models\Tovar::$valueYesNo,
            ],
            /*
            [
                'TAX_ID',
                'value' => 'TAX_ID',
                'filter' => Tax::find()->select(['TYPE_NAME', 'TYPE_ID'])->indexBy('TYPE_ID')->column()
            ],
            */
            //'TAX_ID',
            //'ISACTIVE',
            //'PUBLISHED',
            'FKEY_1C',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                //'class' => 'kartik\grid\ActionColumn',
                'headerOptions' => ['width'=>'120'],
                'header' => Yii::t('app', 'Действия'),
                'urlCreator' => function ($action, $model, $key, $index) {
                    $action = 'tovar-'.$action;
                    return Url::to(['preference/'.$action, 'id' => $model->TOVAR_ID]);
                }
            ],
        ],
    ]); ?>

    <?//php Pjax::end(); ?>
</div>
