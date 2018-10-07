<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TovarTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tovar Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tovar-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tovar Type'), ['tovar-type-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TYPE_ID',
            'TYPE_NAME',
            'SHOWASCATEGORY',
            'PUBLISHED',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                    $action = 'tovar-type-'.$action;
                    return Url::to(['preference/'.$action, 'id' => $model->TYPE_ID]);
                }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
