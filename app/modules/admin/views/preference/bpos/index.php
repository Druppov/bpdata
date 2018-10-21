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

<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
    <?= Html::a(Yii::t('app', 'Добавить точку'), ['bpos-create'], ['class' => 'btn btn-sm btn-success']) ?>
<?php $this->endBlock(); ?>

<div class="bpos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app', 'Действия'),
                'urlCreator' => function ($action, $model, $key, $index) {
                    $action = 'bpos-'.$action;
                    return Url::to(['preference/'.$action, 'id' => $model->POS_ID]);
                }
            ],
        ],

    ]); ?>
    <?php Pjax::end(); ?>
</div>
