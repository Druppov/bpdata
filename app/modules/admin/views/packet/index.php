<?php

use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\PacketIn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PacketInSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Обработка пакета');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
<?= Html::a(Yii::t('app', 'Загрузить пакет'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
<?php $this->endBlock(); ?>

<div class="packet-in-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            [
                'attribute' => 'POS_ID',
                'value' => 'bpos.POS_NAME',
                'filter' => \app\models\PacketIn::getBposFilter($searchModel),
            ],
            'PACKETNO',
            'PACKETFILENAME',
            //'DATA',
            /*
            [
                     'attribute' => 'DATA',
                     'format' => 'raw',
                     'value' => function ($model) {
                        if ($model->image_web_filename!='')
                          return '<img src="'.Yii::$app->homeUrl. '/uploads/packages/'.$model->PACKETFILENAME.'" width="50px" height="auto">'; else return 'no image';
                     },
            ],
            */
            [
                'attribute' => 'PROCESSED',
                'format' => 'raw',
                'value' => function ($model, $index, $widget) {
                    if ($model->PROCESSED=='Y') {
                        return '<span class="glyphicon glyphicon-ok text-success"></span>';
                    } else {
                        return '<span class="glyphicon glyphicon-remove text-danger"></span>';
                    }
                },
                'filter' => PacketIn::$valueYesNo,
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
