<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tovar'), ['tovar-create', 'type'=>$searchModel->TYPE_ID], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TOVAR_ID',
            'NAME',
            'PRINTNAME',
            'TYPE_ID',
            'TAX_ID',
            //'ISACTIVE',
            //'PUBLISHED',
            //'FKEY_1C',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                    $action = 'tovar-'.$action;
                    return Url::to(['preference/'.$action, 'id' => $model->TOVAR_ID]);
                }
            ],
        ],
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataBposProvider,
        'filterModel' => $searchBposModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'POS_ID',
            'POS_NAME',
            'ADDR',
            'PUBLISHED',
        ],

    ]); ?>

    <?php Pjax::end(); ?>
</div>
