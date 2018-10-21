<?php

use app\modules\admin\assets\ThemeHelper;
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
    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

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
        'panel'=>[
            'type'=>'primary',
            'heading'=>$this->title
        ],
        'columns' => [
            'POS_ID',
            'POS_NAME',
            'ADDR',
            [
                //'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'PUBLISHED',
                'value' => 'PUBLISHED',
                //'trueLabel' => 'P',
                //'falseLabel' => 'U',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'PUBLISHED',
                    Bpos::$valuePublished,
                    ['class'=>'form-control','prompt' => 'Все']
                ),
            ],
        ],

    ]); ?>
    <?php Pjax::end(); ?>
</div>
