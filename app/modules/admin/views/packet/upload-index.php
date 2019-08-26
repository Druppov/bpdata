<?php

use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\Packet;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PacketInSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Выгрузка пакета');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
<?= Html::a(Yii::t('app', 'Выгрузить пакет'), ['upload'], ['class' => 'btn btn-sm btn-success']) ?>
<?php $this->endBlock(); ?>

<div class="packet-upload-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            [
                'attribute' => 'DEST_POS_ID',
                //'value' => 'bpos.POS_NAME',
                'value' => function($data) {
                    return '['.$data->DEST_POS_ID.'] '.$data->bpos->POS_NAME;
                },
                'filter' => Packet::getBposFilter($searchModel),
            ],
            'PACKETNO',
            'PACKETFILENAME',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
