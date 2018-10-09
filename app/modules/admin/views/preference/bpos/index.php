<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\Bpos;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\BposSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Точки продаж');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bpos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать точку'), ['bpos-create'], ['class' => 'btn btn-success']) ?>
    </p>

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

            'POS_ID',
            'POS_NAME',
            'ADDR',
            //'PUBLISHED',
            [
                'attribute' => 'PUBLISHED',
                'value' => 'PUBLISHED',
                'filter' => Html::activeDropDownList($searchModel, 'PUBLISHED', Bpos::$valuePublished,['class'=>'form-control','prompt' => 'Публикация']),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                    $action = 'bpos-'.$action;
                    return Url::to(['preference/'.$action, 'id' => $model->POS_ID]);
                }
            ],
        ],

    ]); ?>
    <?php Pjax::end(); ?>
</div>
