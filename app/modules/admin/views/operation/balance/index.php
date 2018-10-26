<?php

use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\models\Balance;
use app\models\Bpos;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\BalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Остатки');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
<?= Html::a(Yii::t('app', 'Добавить остатки'), ['balance-create'], ['class' => 'btn btn-sm btn-success']) ?>
<?php $this->endBlock(); ?>

<div class="balance-index">

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
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'attribute' => 'POS_ID',
                'value' => 'bpos.POS_NAME',
                'filter' => Balance::getBposFilter($searchModel),
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'BALANCEDATE',
                'value' => 'BALANCEDATE',
                'filterType'=> GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'language'=>'ru',
                    'options' => ['placeholder' => 'Укажите дату'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ],
                'format' => 'html',
            ],
            [
                'attribute' => 'TOVAR_ID',
                'value' => 'tovar.NAME',
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'AMOUNT',
                'editableOptions'=>[
                    'formOptions'=>['action' => ['/admin/operation/balance-edit-amount']], // point to the new action
                    //'inputType'=>kartik\editable\Editable::INPUT_MONEY,
                    'options'=>['pluginOptions'=>['min'=>0, 'max'=>5000]]
                ],
                'hAlign'=>'right',
                'vAlign'=>'middle',
                'width'=>'100px',
                'format'=>['decimal', 2],
                'pageSummary'=>true
            ],
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
                'filter' => Balance::$valuePublished,
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => Yii::t('app', 'Действия'),
                'urlCreator' => function ($action, $model, $key, $index) {
                    $action = 'balance-'.$action;
                    return Url::to(['operation/'.$action, 'POS_ID' => $model->POS_ID, 'BALANCEDATE'=>$model->BALANCEDATE, 'TOVAR_ID'=>$model->TOVAR_ID]);
                }
            ],
        ],
    ]); ?>
    <?//php Pjax::end(); ?>
</div>
