<?php

namespace app\modules\admin\controllers;

use app\models\PayCheckIntlTb;
use app\models\Smena;
use app\models\SmenaTb;
use app\models\TovarPrice;
use app\modules\admin\models\BposSearch;
use app\modules\admin\models\PayCheckIntlTbSearch;
use app\modules\admin\models\PayCheckTbSearch;
use app\modules\admin\models\SmenaSearch;
use app\modules\admin\models\SmenaTbSearch;
use app\modules\admin\models\TovarPriceSearch;
use kartik\grid\EditableColumnAction;
use Yii;
use app\models\Balance;
use app\modules\admin\models\BalanceSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * OperationController implements the CRUD actions for Balance model.
 */
class OperationController extends Controller
{
    /*
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'balance-edit-amount' => [                                       // identifier for your editable column action
                'class' => EditableColumnAction::className(),     // action class name
                'modelClass' => Balance::className(),                // the model for the record being edited
                'outputValue' => function ($model, $attribute, $key, $index) {
                    return (int) $model->$attribute / 100;      // return any custom output value if desired
                },
                'outputMessage' => function($model, $attribute, $key, $index) {
                    return '';                                  // any custom error to return after model save
                },
                'showModelErrors' => true,                        // show model validation errors after save
                'errorOptions' => ['header' => '']                // error summary HTML options
                // 'postOnly' => true,
                // 'ajaxOnly' => true,
                // 'findModel' => function($id, $action) {},
                // 'checkAccess' => function($action, $model) {}
            ]
        ]);
    }
    */

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'balance-delete' => ['POST'],
                    'smena-delete' => ['POST'],
                    'smena-tb-delete' => ['POST'],
                    'smena-list' => ['POST'],
                    'pay-check-intl-delete' => ['POST'],
                    //'balance-edit-amount' => ['POST'],
                ],
            ],
        ];
    }

    /*
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'balance-edit-amount' => [                                       // identifier for your editable action
                'class' => EditableColumnAction::className(),     // action class name
                'modelClass' => Balance::className(),                // the update model class
            ]
        ]);
    }
    */

    public function actionBalanceEditAmount()
    {
        if (Yii::$app->request->post('hasEditable')) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            /*
            Yii::info('processed post:' . print_r($_POST,true));
            return Json::decode(Yii::$app->request->post('editableKey'));
            return [
                'output'    => '',
                'message'   => '',
            ];
            */
            $pkData = Json::decode(Yii::$app->request->post('editableKey'));
            $model = $this->findBalanceModel($pkData['POS_ID'], $pkData['BALANCEDATE'], $pkData['TOVAR_ID']);

            $out = [
                'output'    => '',
                'message'   => '',
            ];

            // fetch the first entry in posted data (there should
            // only be one entry anyway in this array for an
            // editable submission)
            // - $posted is the posted data for Model without any indexes
            // - $post is the converted array for single model validation
            $posted = current($_POST[$model->formName()]);
            $post[$model->formName()] = $posted;
            Yii::info('processed post:' . print_r($posted,true));

            if ($model->load($post)) {
                if (!$model->save()) {
                    $out = [
                        'output'    => '',
                        'message'   => $model->getFirstError(),
                    ];
                }
                Yii::info('editable returns:' . print_r($out,true));
                return $out;
            }
        }
    }

    public function actionSmenaLists($pos_id)
    {
        $smenaList = Smena::getSmenaList($pos_id);

        echo "<option value='' selected='selected'>Выберите смену</option>";
        foreach ($smenaList as $key => $value) {
            echo "<option value='".$key."'>".$value."</option>";
        }
    }

    /**
     * Lists all Balance models.
     * @return mixed
     */
    public function actionBalanceIndex()
    {
        $searchModel = new BalanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['TOVAR_NAME' => SORT_ASC];

        return $this->render('balance/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all TovarPrice models.
     * @return mixed
     */
    public function actionTovarPriceReport()
    {
        $searchModel = new TovarPriceSearch();
        $searchModel->ISUSED = TovarPrice::$valueYes;
        $searchModel->IS_USE_MAX_DATE = true;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tovar-price/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Bpos models.
     * @return mixed
     */
    public function actionBposReport()
    {
        $searchModel = new BposSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('bpos/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Smena models.
     * @return mixed
     */
    public function actionSmenaIndex()
    {
        $searchModel = new SmenaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('smena/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all SmenaTb models.
     * @return mixed
     */
    public function actionSmenaTbIndex()
    {
        $searchModel = new SmenaTbSearch();
        $searchModel->POS_ID = -1;

        $searchPayCheckTbModel = new PayCheckTbSearch();
        $searchPayCheckTbModel->IS_GROUP = true;

        $searchPayCheckTbRetModel = new PayCheckTbSearch();
        $searchPayCheckTbRetModel->IS_GROUP = true;

        $searchPayCheckIntlTbModel = new PayCheckIntlTbSearch();
        $searchPayCheckIntlTbModel->IS_GROUP = true;

        if (Yii::$app->request->isGet || Yii::$app->request->isPost) {
            $searchModel->load(Yii::$app->request->queryParams);

            $searchPayCheckTbModel->POS_ID = $searchModel->POS_ID;
            $searchPayCheckTbModel->RET = 0;
            $searchPayCheckTbModel->SMENA_ID = $searchModel->SMENA_ID;
            $dataPayCheckTbProvider = $searchPayCheckTbModel->search(Yii::$app->request->queryParams);
            $dataPayCheckTbProvider->sort->sortParam = 'sortPayCheckTb';

            $searchPayCheckTbRetModel->POS_ID = $searchModel->POS_ID;
            $searchPayCheckTbRetModel->RET = 1;
            $searchPayCheckTbRetModel->SMENA_ID = $searchModel->SMENA_ID;
            $dataPayCheckTbRetProvider = $searchPayCheckTbRetModel->search(Yii::$app->request->queryParams);
            $dataPayCheckTbRetProvider->sort->sortParam = 'sortPayCheckTbRet';

            $searchPayCheckIntlTbModel->POS_ID = $searchModel->POS_ID;
            $searchPayCheckIntlTbModel->SMENA_ID = $searchModel->SMENA_ID;
            $dataPayCheckIntlTbProvider = $searchPayCheckIntlTbModel->search(Yii::$app->request->queryParams);
            $dataPayCheckIntlTbProvider->sort->sortParam = 'sortPayCheckIntlTb';
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('smena-tb/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'searchPayCheckTbModel' => $searchPayCheckTbModel,
            'dataPayCheckTbProvider' => $dataPayCheckTbProvider,
            //'searchPayCheckTbRetModel' => $searchPayCheckTbRetModel,
            'dataPayCheckTbRetProvider' => $dataPayCheckTbRetProvider,
            'dataPayCheckIntlTbProvider' => $dataPayCheckIntlTbProvider,
        ]);
    }

    /**
     * Lists all PayCheckIntlTb models.
     * @return mixed
     */
    public function actionPayCheckIntlIndex()
    {
        $searchModel = new PayCheckIntlTbSearch();
        $searchModel->IS_GROUP = true;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('pay-check-intl/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all PayCheckIntlTb models.
     * @return mixed
     */
    public function actionPayCheckIndex()
    {
        $searchModel = new PayCheckTbSearch();
        $searchModel->IS_GROUP = true;
        //$searchModel->POS_ID = -1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->pagination = false;

        return $this->render('pay-check/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Balance model.
     * @param integer $POS_ID
     * @param string $BALANCEDATE
     * @param integer $TOVAR_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionBalanceView($POS_ID, $BALANCEDATE, $TOVAR_ID)
    {
        return $this->render('balance/view', [
            'model' => $this->findBalanceModel($POS_ID, $BALANCEDATE, $TOVAR_ID),
        ]);
    }

    /**
     * Displays a single Smena model.
     * @param integer $POS_ID
     * @param integer $SMENA_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSmenaView($POS_ID, $SMENA_ID)
    {
        return $this->render('smena/view', [
            'model' => $this->findSmenaModel($POS_ID, $SMENA_ID),
        ]);
    }

    /**
     * Displays a single SmenaTb model.
     * @param integer $POS_ID
     * @param integer $SMENA_ID
     * @param integer $PERSON_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSmenaTbView($POS_ID, $SMENA_ID, $PERSON_ID)
    {
        return $this->render('smena-tb/view', [
            'model' => $this->findSmenaTbModel($POS_ID, $SMENA_ID, $PERSON_ID),
        ]);
    }

    /**
     * Displays a single PayCheckIntlTb model.
     * @param integer $POS_ID
     * @param integer $CHECKNO
     * @param integer $STRNO
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPayCheckIntlView($POS_ID, $CHECKNO, $STRNO)
    {
        return $this->render('pay-check-intl/view', [
            'model' => $this->findPayCheckIntlTbModel($POS_ID, $CHECKNO, $STRNO),
        ]);
    }

    /**
     * Creates a new Balance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionBalanceCreate()
    {
        $model = new Balance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['balance-view', 'POS_ID' => $model->POS_ID, 'BALANCEDATE' => $model->BALANCEDATE, 'TOVAR_ID' => $model->TOVAR_ID]);
        }

        return $this->render('balance/create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Smena model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSmenaCreate()
    {
        $model = new Smena();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['smena-view', 'POS_ID' => $model->POS_ID, 'SMENA_ID' => $model->SMENA_ID]);
        }

        return $this->render('smena/create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new SmenaTb model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSmenaTbCreate()
    {
        $model = new SmenaTb();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['smena-tb-view', 'POS_ID' => $model->POS_ID, 'SMENA_ID' => $model->SMENA_ID, 'PERSON_ID' => $model->PERSON_ID]);
        }

        return $this->render('smena-tb/create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new PayCheckIntlTb model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPayCheckIntlCreate()
    {
        $model = new PayCheckIntlTb();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['pay-check-intl-view', 'POS_ID' => $model->POS_ID, 'CHECKNO' => $model->CHECKNO, 'STRNO' => $model->STRNO]);
        }

        return $this->render('pay-check-intl/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Balance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $POS_ID
     * @param string $BALANCEDATE
     * @param integer $TOVAR_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionBalanceUpdate($POS_ID, $BALANCEDATE, $TOVAR_ID)
    {
        $model = $this->findBalanceModel($POS_ID, $BALANCEDATE, $TOVAR_ID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['balance-view', 'POS_ID' => $model->POS_ID, 'BALANCEDATE' => $model->BALANCEDATE, 'TOVAR_ID' => $model->TOVAR_ID]);
        }

        return $this->render('balance/update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Smena model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $POS_ID
     * @param integer $SMENA_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSmenaUpdate($POS_ID, $SMENA_ID)
    {
        $model = $this->findSmenaModel($POS_ID, $SMENA_ID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['smena-view', 'POS_ID' => $model->POS_ID, 'SMENA_ID' => $model->SMENA_ID]);
        }

        return $this->render('smena/update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SmenaTb model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $POS_ID
     * @param integer $SMENA_ID
     * @param integer $PERSON_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSmenaTbUpdate($POS_ID, $SMENA_ID, $PERSON_ID)
    {
        $model = $this->findSmenaTbModel($POS_ID, $SMENA_ID, $PERSON_ID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['smena-tb-view', 'POS_ID' => $model->POS_ID, 'SMENA_ID' => $model->SMENA_ID, 'PERSON_ID' => $model->PERSON_ID]);
        }

        return $this->render('smena-tb/update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PayCheckIntlTb model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $POS_ID
     * @param integer $CHECKNO
     * @param integer $STRNO
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPayCheckIntlUpdate($POS_ID, $CHECKNO, $STRNO)
    {
        $model = $this->findPayCheckIntlTbModel($POS_ID, $CHECKNO, $STRNO);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['pay-check-intl-view', 'POS_ID' => $model->POS_ID, 'CHECKNO' => $model->CHECKNO, 'STRNO' => $model->STRNO]);
        }

        return $this->render('pay-check-intl/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Balance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $POS_ID
     * @param string $BALANCEDATE
     * @param integer $TOVAR_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionBalanceDelete($POS_ID, $BALANCEDATE, $TOVAR_ID)
    {
        $this->findBalanceModel($POS_ID, $BALANCEDATE, $TOVAR_ID)->delete();

        return $this->redirect(['balance-index']);
    }

    /**
     * Deletes an existing Smena model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $POS_ID
     * @param integer $SMENA_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSmenaDelete($POS_ID, $SMENA_ID)
    {
        $this->findSmenaModel($POS_ID, $SMENA_ID)->delete();

        return $this->redirect(['smena-index']);
    }

    /**
     * Deletes an existing SmenaTb model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $POS_ID
     * @param integer $SMENA_ID
     * @param integer $PERSON_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSmenaTbDelete($POS_ID, $SMENA_ID, $PERSON_ID)
    {
        $this->findSmenaTbModel($POS_ID, $SMENA_ID, $PERSON_ID)->delete();

        return $this->redirect(['smena-tb-index']);
    }

    /**
     * Deletes an existing PayCheckIntlTb model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $POS_ID
     * @param integer $CHECKNO
     * @param integer $STRNO
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPayCheckIntlDelete($POS_ID, $CHECKNO, $STRNO)
    {
        $this->findPayCheckIntlTbModel($POS_ID, $CHECKNO, $STRNO)->delete();

        return $this->redirect(['pay-check-intl-index']);
    }

    /**
     * Finds the Balance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $POS_ID
     * @param string $BALANCEDATE
     * @param integer $TOVAR_ID
     * @return Balance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findBalanceModel($POS_ID, $BALANCEDATE, $TOVAR_ID)
    {
        if (($model = Balance::findOne(['POS_ID' => $POS_ID, 'BALANCEDATE' => $BALANCEDATE, 'TOVAR_ID' => $TOVAR_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the Smena model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $POS_ID
     * @param integer $SMENA_ID
     * @return Smena the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findSmenaModel($POS_ID, $SMENA_ID)
    {
        if (($model = Smena::findOne(['POS_ID' => $POS_ID, 'SMENA_ID' => $SMENA_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the SmenaTb model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $POS_ID
     * @param integer $SMENA_ID
     * @param integer $PERSON_ID
     * @return SmenaTb the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findSmenaTbModel($POS_ID, $SMENA_ID, $PERSON_ID)
    {
        if (($model = SmenaTb::findOne(['POS_ID' => $POS_ID, 'SMENA_ID' => $SMENA_ID, 'PERSON_ID' => $PERSON_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the PayCheckIntlTb model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $POS_ID
     * @param integer $CHECKNO
     * @param integer $STRNO
     * @return PayCheckIntlTb the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPayCheckIntlTbModel($POS_ID, $CHECKNO, $STRNO)
    {
        if (($model = PayCheckIntlTb::findOne(['POS_ID' => $POS_ID, 'CHECKNO' => $CHECKNO, 'STRNO' => $STRNO])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
