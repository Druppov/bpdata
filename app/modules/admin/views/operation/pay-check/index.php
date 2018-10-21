<?php

use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\PayCheckTb;
use app\models\Smena;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PayCheckIntlTbSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Чеки');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
<?= Html::a(Yii::t('app', 'Добавить чек'), ['pay-check-create'], ['class' => 'btn btn-sm btn-success']) ?>
<?php $this->endBlock(); ?>

<div class="pay-check-tb-index">

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
                'filter' => PayCheckTb::getBposFilter($searchModel, 'smena-selector-id'),
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
            /*
            [
                'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'RET',
                'value' => 'RET',
                'trueLabel' => 0,
                'falseLabel' => 1,
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'RET',
                    [0 => 'Продажа', 1 => 'Возврат'],
                    ['class'=>'form-control','prompt' => 'Все']
                ),
            ],
            */
            [
                'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'PUBLISHED',
                'value' => 'PUBLISHED',
                'trueLabel' => PayCheckTb::$valuePublished['P'],
                'falseLabel' => PayCheckTb::$valuePublished['U'],
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'PUBLISHED',
                    PayCheckTb::$valuePublished,
                    ['class'=>'form-control','prompt' => 'Все']
                ),
            ],
            //'ROW_NPP',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?//php Pjax::end(); ?>
</div>
