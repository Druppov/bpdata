<?php

use app\models\Personal;
use app\modules\admin\assets\ThemeHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PersonalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Сотрудники');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock(ThemeHelper::BLOCK_HEADER_BUTTONS); ?>
<?= Html::a(Yii::t('app', 'Добавить сотрудника'), ['/admin/preference/personal-create'], ['class' => 'btn btn-sm btn-success']) ?>
<?php $this->endBlock(); ?>

<div class="personal-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?//php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [

            [
                'attribute' => 'PERSON_ID',
                'headerOptions' => ['width'=>80],
            ],
            'FIO',
            [
                'attribute' => 'ISACTIVE',
                'format' => 'raw',
                'value' => function ($model, $index, $widget) {
                    if ($model->ISACTIVE=='Y') {
                        return '<span class="glyphicon glyphicon-ok text-success"></span>';
                    } else {
                        return '<span class="glyphicon glyphicon-remove text-danger"></span>';
                    }
                },
                'filter' => Personal::$valueYesNo,
            ],
            [
                'attribute' => 'PUBLISHED',
                'format' => 'raw',
                'value' => function ($model, $index, $widget) {
                    if ($model->PUBLISHED==Personal::$valuePublished) {
                        return '<span class="glyphicon glyphicon-ok text-success"></span>';
                    } else {
                        return '<span class="glyphicon glyphicon-remove text-danger"></span>';
                    }
                },
                'filter' => Personal::$valuePublished,
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'headerOptions' => ['width'=>'120'],
                'header' => Yii::t('app', 'Действия'),
                'urlCreator' => function ($action, $model, $key, $index) {
                    $action = 'personal-'.$action;
                    return Url::to(['preference/'.$action, 'id' => $model->PERSON_ID]);
                    /*
                    if ($action=='view') {
                        $action = 'update';
                    }
                    */
                    return Url::to(['/admin/users/'.$action, 'id' => $model->PERSON_ID]);
                }
            ],
        ],
    ]); ?>
    <?//php Pjax::end(); ?>
</div>
