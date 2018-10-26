<?php

use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\PayCheckIntlTb;
use app\models\Smena;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PayCheckIntlTbSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Внутренний расход');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
<?= Html::a(Yii::t('app', 'Добавить внутренний расход'), ['pay-check-intl-create'], ['class' => 'btn btn-sm btn-success']) ?>
<?php $this->endBlock(); ?>

<div class="pay-check-intl-tb-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
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
        'panel'=>[
            'type'=>'primary',
            'heading'=>$this->title
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'POS_ID',
                'value' => 'bpos.POS_NAME',
                'filter' => PayCheckIntlTb::getBposFilter($searchModel, 'smena-selector-id'),
            ],
            [
                'attribute' => 'SMENA_ID',
                'label' => Yii::t('app', 'Смена'),
                'value' => function($model) {
                    return Smena::getSmenaName($model->POS_ID);
                },
                'filter' => Html::activeDropDownList($searchModel, 'SMENA_ID',
                    Smena::getSmenaList($searchModel->POS_ID),
                    [
                        'id'=>'smena-selector-id',
                        'class'=>'form-control',
                        'prompt'=>'Выберите смену',
                        ]
                )
            ],
            //'CHECKNO',
            //'STRNO',
            [
                'attribute' => 'TOVAR_ID',
                'value' => 'tovar.NAME',
            ],
            'KVO',
            'PRICE',
            'SUMMA',
            [
                'attribute' => 'PUBLISHED',
                'format' => 'raw',
                'value' => function ($model, $index, $widget) {
                    if ($model->PUBLISHED=='P') {
                        return '<span class="glyphicon glyphicon-ok text-success"></span>';
                    } else {
                        return '<span class="glyphicon glyphicon-remove text-danger"></span>';
                    }
                },
                'filter' => \app\models\PayCheckIntlTb::$valuePublished,
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?//php Pjax::end(); ?>
</div>
