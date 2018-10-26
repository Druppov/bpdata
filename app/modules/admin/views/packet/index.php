<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\PacketIn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PacketInSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Packet Ins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packet-in-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Packet In'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
                'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'PROCESSED',
                'value' => 'PROCESSED',
                'trueLabel' => PacketIn::$processed['Y'],
                'falseLabel' => PacketIn::$processed['N'],
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'PROCESSED',
                    PacketIn::$processed,
                    ['class'=>'form-control','prompt' => 'Все']
                ),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php //Pjax::end(); ?>
</div>
