<?php

namespace app\modules\admin\controllers;

use app\models\Tovar;
use app\models\TovarPrice;
use app\modules\admin\models\TovarPriceSearch;
use app\modules\admin\models\TovarSearch;
use Yii;
use app\models\Bpos;
use app\modules\admin\models\BposSearch;
use app\models\TovarType;
use app\modules\admin\models\TovarTypeSearch;
use app\models\Personal;
use app\modules\admin\models\PersonalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PreferenceController implements the CRUD actions for Bpos model.
 */
class PreferenceController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'bpos-delete' => ['POST'],
                    'tovar-type-delete' => ['POST'],
                    'personal-delete' => ['POST'],
                    'tovar-delete' => ['POST'],
                    'tovar-price-delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Bpos models.
     * @return mixed
     */
    public function actionBposIndex()
    {
        $searchModel = new BposSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('bpos/index', [
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

        return $this->render('bpos/report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bpos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionBposView($id)
    {
        return $this->render('bpos/view', [
            'model' => $this->findBposModel($id),
        ]);
    }

    /**
     * Creates a new Bpos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionBposCreate()
    {
        $model = new Bpos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['bpod-view', 'id' => $model->POS_ID]);
        }

        return $this->render('bpos/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Bpos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionBposUpdate($id)
    {
        $model = $this->findBposModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['bpos-view', 'id' => $model->POS_ID]);
        }

        return $this->render('bpos/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Bpos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionBposDelete($id)
    {
        $this->findBposModel($id)->delete();

        return $this->redirect(['bpod-index']);
    }

    /**
     * Lists all TovarType models.
     * @return mixed
     */
    public function actionTovarTypeIndex()
    {
        $searchModel = new TovarTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tovar-type/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TovarType model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTovarTypeView($id)
    {
        return $this->render('tovar-type/view', [
            'model' => $this->findTovarTypeModel($id),
        ]);
    }

    /**
     * Creates a new TovarType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTovarTypeCreate()
    {
        $model = new TovarType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['tovar-type-view', 'id' => $model->TYPE_ID]);
        }

        return $this->render('tovar-type/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TovarType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTovarTypeUpdate($id)
    {
        $model = $this->findTovarTypeModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['tovar-type-view', 'id' => $model->TYPE_ID]);
        }

        return $this->render('tovar-type/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TovarType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTovarTypeDelete($id)
    {
        $this->findTovarTypeModel($id)->delete();

        return $this->redirect(['tovar-type-index']);
    }

    /**
     * Lists all Personal models.
     * @return mixed
     */
    public function actionPersonalIndex()
    {
        $searchModel = new PersonalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('personal/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Personal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPersonalView($id)
    {
        return $this->render('personal/view', [
            'model' => $this->findPersonalModel($id),
        ]);
    }

    /**
     * Creates a new Personal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPersonalCreate()
    {
        $model = new Personal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['personal-view', 'id' => $model->PERSON_ID]);
        }

        return $this->render('personal/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Personal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPersonalUpdate($id)
    {
        $model = $this->findPersonalModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['personal-view', 'id' => $model->PERSON_ID]);
        }

        return $this->render('personal/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Personal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionPersonalDelete($id)
    {
        $this->findPersonalModel($id)->delete();

        return $this->redirect(['personal-index']);
    }

    /**
     * Lists all Tovar models.
     * @param null $type
     * @return mixed
     */
    public function actionTovarIndex($type=null)
    {
        $searchModel = new TovarSearch();
        if (!is_null($type)) {
            $searchModel->TYPE_ID = $type;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tovar/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tovar model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTovarView($id)
    {
        return $this->render('tovar/view', [
            'model' => $this->findTovarModel($id),
        ]);
    }

    /**
     * Creates a new Tovar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param null $type
     * @return mixed
     */
    public function actionTovarCreate($type=null)
    {
        $model = new Tovar();
        if (!is_null($type)) {
            $model->TYPE_ID = $type;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['tovar-view', 'id' => $model->TOVAR_ID]);
        }

        return $this->render('tovar/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tovar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTovarUpdate($id)
    {
        $model = $this->findTovarModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['tovar-view', 'id' => $model->TOVAR_ID]);
        }

        return $this->render('tovar/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tovar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionTovarDelete($id)
    {
        $model = $this->findTovarModel($id);
        $type = $model->TYPE_ID;
        $model->delete();

        return $this->redirect(['tovar-index', 'type'=>$type]);
    }

    /**
     * Lists all TovarPrice models.
     * @return mixed
     */
    public function actionTovarPriceIndex()
    {
        $searchModel = new TovarPriceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tovar-price/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TovarPrice model.
     * @param integer $POS_ID
     * @param integer $TOVAR_ID
     * @param string $PRICE_DATE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTovarPriceView($POS_ID, $TOVAR_ID, $PRICE_DATE)
    {
        $model = $this->findTovarPriceModel($POS_ID, $TOVAR_ID, $PRICE_DATE);
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('tovar-price/view', [
                'model' => $model,
            ]);
        } else {
            return $this->render('tovar-price/view', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new TovarPrice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTovarPriceCreate()
    {
        $model = new TovarPrice();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['tovar-price-view', 'POS_ID' => $model->POS_ID, 'TOVAR_ID' => $model->TOVAR_ID, 'PRICE_DATE' => $model->PRICE_DATE]);
        }

        return $this->render('tovar-price/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TovarPrice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $POS_ID
     * @param integer $TOVAR_ID
     * @param string $PRICE_DATE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTovarPriceUpdate($POS_ID, $TOVAR_ID, $PRICE_DATE)
    {
        $model = $this->findTovarPriceModel($POS_ID, $TOVAR_ID, $PRICE_DATE);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save(false);
            //return $this->redirect(['tovar-price-view', 'POS_ID' => $model->POS_ID, 'TOVAR_ID' => $model->TOVAR_ID, 'PRICE_DATE' => $model->PRICE_DATE]);
        } else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('tovar-price/update', [
                    'model' => $model,
                ]);
            } else {
                return $this->render('tovar-price/update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing TovarPrice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $POS_ID
     * @param integer $TOVAR_ID
     * @param string $PRICE_DATE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTovarPriceDelete($POS_ID, $TOVAR_ID, $PRICE_DATE)
    {
        $this->findTovarPriceModel($POS_ID, $TOVAR_ID, $PRICE_DATE)->delete();

        return $this->redirect(['tovar-price-index']);
    }

    /**
     * Finds the Bpos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bpos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findBposModel($id)
    {
        if (($model = Bpos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the TovarType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TovarType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findTovarTypeModel($id)
    {
        if (($model = TovarType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the Personal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Personal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPersonalModel($id)
    {
        if (($model = Personal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the Tovar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tovar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findTovarModel($id)
    {
        if (($model = Tovar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the TovarPrice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $POS_ID
     * @param integer $TOVAR_ID
     * @param string $PRICE_DATE
     * @return TovarPrice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findTovarPriceModel($POS_ID, $TOVAR_ID, $PRICE_DATE)
    {
        if (($model = TovarPrice::findOne(['POS_ID' => $POS_ID, 'TOVAR_ID' => $TOVAR_ID, 'PRICE_DATE' => $PRICE_DATE])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
