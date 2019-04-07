<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\PacketIn;
use app\modules\admin\models\PacketInSearch;
use yii\db\Exception;
use yii\db\IntegrityException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PacketController implements the CRUD actions for PacketIn model.
 */
class PacketController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PacketIn models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PacketInSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PacketIn model.
     * @param integer $POS_ID
     * @param integer $PACKETNO
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($POS_ID, $PACKETNO)
    {
        return $this->render('view', [
            'model' => $this->findModel($POS_ID, $PACKETNO),
        ]);
    }

    /**
     * Creates a new PacketIn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PacketIn();

        if (Yii::$app->request->isPost) {
            $attrubute = Html::getInputName(new PacketIn(), 'PACKETFILENAME');
            $files = UploadedFile::getInstancesByName($attrubute);
            foreach ($files as $file) {
                /*
                 * Сохраняем архив в БД
                 */
                if (!$file->hasError              //checks for errors
                    && is_uploaded_file($file->tempName)) { //checks that file is uploaded
                    //echo file_get_contents($_FILES['uploadedfile']['tmp_name']);
                    $model = new PacketIn();
                    $model->PACKETFILENAME = $file->name;
                    if (preg_match('/mgt-(\d+)-(\d+)-(\d+)\.(zip|rar)/', $file->name, $output)) {
                        $model->POS_ID = (int)$output[1];
                        $model->PACKETNO = (int)$output[3];
                        $model->DATA = file_get_contents($file->tempName);
                        $model->PROCESSED = 'N';

                        $connection = Yii::$app->db;
                        $transaction = $connection->beginTransaction();
                        try {
                            if ($model->save()) {
                                //Обработка информации
                                PacketIn::processingAll();
                                $transaction->commit();
                            }  else {
                                //var_dump ($model->getErrors());
                                $transaction->rollBack();
                                //echo Json::encode($model->getErrors());
                                //die();
                            }
                        } catch (IntegrityException $e) {
                            $transaction->rollBack();
                            throw new HttpException(500,"YOUR MESSAGE.", 405);
                        } catch (Exception $e) {
                            $transaction->rollBack();
                            throw new HttpException(500,"YOUR MESSAGE", 405);
                        }
                    } else {
                        //ToDo: Ошибка, имя файла не по шаблону
                    }
                } else {
                    //ToDo: Ошибка при загрузке
                }
            }

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PacketIn model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $POS_ID
     * @param integer $PACKETNO
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($POS_ID, $PACKETNO)
    {
        $model = $this->findModel($POS_ID, $PACKETNO);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'POS_ID' => $model->POS_ID, 'PACKETNO' => $model->PACKETNO]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PacketIn model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $POS_ID
     * @param integer $PACKETNO
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($POS_ID, $PACKETNO)
    {
        $this->findModel($POS_ID, $PACKETNO)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PacketIn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $POS_ID
     * @param integer $PACKETNO
     * @return PacketIn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($POS_ID, $PACKETNO)
    {
        if (($model = PacketIn::findOne(['POS_ID' => $POS_ID, 'PACKETNO' => $PACKETNO])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
