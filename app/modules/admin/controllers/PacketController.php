<?php

namespace app\modules\admin\controllers;

use app\models\ActiveRecord;
use app\models\Balance;
use app\models\Bpos;
use app\models\Packet;
use app\models\Settings;
use app\models\Tovar;
use app\modules\admin\models\PacketSearch;
use Yii;
use app\models\PacketIn;
use app\modules\admin\models\PacketInSearch;
use yii\db\Exception;
use yii\db\IntegrityException;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException as NotFoundHttpExceptionAlias;
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
     * @throws NotFoundHttpExceptionAlias if the model cannot be found
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
                $res = true;
                if (!$file->hasError              //checks for errors
                    && is_uploaded_file($file->tempName)) { //checks that file is uploaded
                    //echo file_get_contents($_FILES['uploadedfile']['tmp_name']);
                    //$connection = Yii::$app->db;
                    //$transaction = $connection->beginTransaction();

                    //$transaction = PacketIn::getDb()->beginTransaction();
                    //try {
                        $model = new PacketIn();
                        $model->PACKETFILENAME = $file->name;
                        if (preg_match('/mgt-(\d+)-(\d+)-(\d+)\.(zip|rar)/', $file->name, $output)) {
                            $model->POS_ID = (int)$output[1];
                            $model->PACKETNO = (int)$output[3];
                            $model->DATA = file_get_contents($file->tempName);
                            $model->PROCESSED = 'N';
                            if ($model->save()) {
                                //Обработка информации
                                PacketIn::processingAll();
                                //$transaction->commit();

                            }  else {
                                //$transaction->rollBack();
                            }
                        } else {
                            //ToDo: Ошибка, имя файла не по шаблону
                            Yii::$app->session->setFlash('error', 'Имя файла не по шаблону.');
                        }
                    /*
                    } catch (IntegrityException $e) {
                        $transaction->rollBack();
                        throw new HttpException(500,"YOUR MESSAGE: ".$e->getMessage(), 405);
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        throw new HttpException(500,"YOUR MESSAGE: ".$e->getMessage(), 405);
                    }
                    */
                } else {
                    //ToDo: Ошибка при загрузке
                    Yii::$app->session->setFlash('error', 'Ошибка при загрузке');
                }
            }

            Yii::$app->session->setFlash('success', 'Все прошло удачно');
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
     * @throws NotFoundHttpExceptionAlias if the model cannot be found
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
     * @throws NotFoundHttpExceptionAlias if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($POS_ID, $PACKETNO)
    {
        $this->findModel($POS_ID, $PACKETNO)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Lists all PacketIn models.
     * @return mixed
     */
    public function actionUploadIndex()
    {
        $searchModel = new PacketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('upload-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpload()
    {
        //$path = Yii::$app->basePath . (substr(Packet::$uploadPath, -1)=='/' ? substr(Packet::$uploadPath, 0, -1) : Packet::$uploadPath);
        $path = Yii::$app->basePath . Packet::$uploadPath;
        //$path = !empty(Settings::getValue('bpos', 'bpos_io')) ? Settings::getValue('bpos', 'bpos_io') : Yii::$app->basePath . Packet::$uploadPath;
        $tmpPath = $path.'/tmp';

        if (!$this->makeDir($path)) {
            throw new NotFoundHttpExceptionAlias(Yii::t('app', 'Папка').' '.$path.' '.Yii::t('app', 'не может быть создана.'));
        }
        //$this->clearDir($tmpPath);
        $this->clearDir($path);

        if (!$this->makeDir($tmpPath)) {
            throw new NotFoundHttpExceptionAlias(Yii::t('app', 'Папка').' '.$tmpPath.' '.Yii::t('app', 'не может быть создана.'));
        }
        //$this->clearDir($tmpPath);

        $list = Packet::getExportTables();
        $storedFileName = null;
        if (!is_null($list) && is_array($list)) {
            foreach ($list as $key => $modelName) {
                $rows = $modelName::find()
                    ->where(['PUBLISHED'=>$modelName::$valuePublishedU])
                    ->all();

                if (!empty($rows)) {
                    $fileName = $modelName::tableName().'.xml';
                    $xmlData = $this->renderPartial('_xml_' . $key, [
                        'rows' => $rows
                    ]);
                    file_put_contents($tmpPath . '/' . $fileName, $xmlData);
                    $storedFileName[$fileName] = $tmpPath.'/'.$fileName;
                }

                /*
                 * Если выгружается TOVARY, то
                 * Если товар неактивный и с ключом 1С должен попадать в остатки.
                 */
                if ($modelName==Tovar::className()) {
                    $bposes = Bpos::find()->all();
                    foreach ($bposes as $bpos) {
                        foreach ($rows as $row) {
                            $balance = Balance::find()
                                ->where(['TOVAR_ID'=>$row->TOVAR_ID, 'POS_ID'=>$bpos->POS_ID])
                                ->count();
                            if (empty($balance) && $row->FKEY_1C>0) {
                                $balance = new Balance();
                                $balance->POS_ID = $bpos->POS_ID;
                                $balance->BALANCEDATE = date('Y-m-d');
                                $balance->TOVAR_ID = $row->TOVAR_ID;
                                $balance->AMOUNT = 0;
                                $balance->PUBLISHED = Balance::$valuePublishedP;
                                $balance->save(false);
                            }
                        }
                    }
                }
            }
        }

        /*
         * Если сгенерировался хотя бы один файл, то формируем архив для каждой точки
         */
        //if (!is_null($storedFileName)) {
        $isDownloadOk = true;
            $bposes = Bpos::find()->all();
            foreach ($bposes as $bpos) {
                $packetNo = Packet::find()
                    ->where(['DEST_POS_ID'=>$bpos->POS_ID])
                    ->max('PACKETNO');
                if (empty($packetNo)) {
                    $packetNo = 1;
                } else {
                    $packetNo++;
                }
                $iniData = $this->renderPartial('_data', [
                    'recipient' => $bpos->POS_ID,
                    'packetno' => $packetNo,
                ]);
                $this->clearDir($path, 'data.ini');
                file_put_contents($tmpPath . '/data.ini', $iniData);
                $storedFileName['data.ini'] = $tmpPath.'/'.'data.ini';

                /*
                 * Выбираем зависимые таблицы
                 */
                $list = Packet::getExportDependenceTables($bpos->POS_ID);
                if (!is_null($list) && is_array($list)) {
                    foreach ($list as $key => $modelName) {
                        $fileName = $modelName::tableName().'.xml';
                        unset($storedFileName[$fileName]);
                        $this->clearDir($path, $fileName);
                        $rows = $modelName::find()
                            ->where([
                                'PUBLISHED'=>$modelName::$valuePublishedU,
                                'POS_ID' => $bpos->POS_ID,
                            ])
                            ->all();

                        if (!empty($rows)) {
                            $xmlData = $this->renderPartial('_xml_' . $key, [
                                'rows' => $rows
                            ]);
                            file_put_contents($tmpPath . '/' . $fileName, $xmlData);
                            $storedFileName[$fileName] = $tmpPath.'/'.$fileName;
                        }
                    }
                }
                /********************************************************************************/

                $packetFileName = sprintf('mgt-00-%02d-%05d.zip', $bpos->POS_ID, $packetNo);
                $model = new Packet();
                if ($model->zipping($tmpPath, $path.'/'.$packetFileName)) {
                    $model->zipping($tmpPath, $path.'/arc/'.$packetFileName);
                    $model->POS_ID = 0;
                    $model->DEST_POS_ID = $bpos->POS_ID;
                    $model->PACKETNO = $packetNo;
                    $model->PACKETFILENAME = $packetFileName;
                    if ($model->save(false)) {
                        //$this->download($path.'/'.$packetFileName);
                    } else {
                        $isDownloadOk = false;
                    }
                }
            }
        //}
        $this->clearDir($tmpPath);

        /*
         * Если все ОК, то в выгруженных данных заменяем PUBLISHED=P
         */
        $dir = !empty(Settings::getValue('bpos', 'bpos_io')) ? Settings::getValue('bpos', 'bpos_io') : '';
        $list = array_merge(Packet::getExportTables(), Packet::getExportDependenceTables());
        if (!is_null($list) && is_array($list) && $isDownloadOk) {
            foreach ($list as $key => $modelName) {
                if ($key!='bpos') {
                    $modelName::updateAll(['PUBLISHED' => $modelName::$valuePublishedP], ['PUBLISHED' => $modelName::$valuePublishedU]);
                }
            }

            if (!empty($dir)) {
                /*
                 * копирыем выгрузку в папку с флешкой, если параметр задан
                 */
                BaseFileHelper::removeDirectory($dir);
                BaseFileHelper::copyDirectory($path, $dir, ['except'=>['tmp','arc']]);
            }
        }

        Yii::$app->session->setFlash('success', 'Все прошло удачно. Файлы в папке: '.empty($dir)?$path:$dir);
        return $this->redirect(['upload-index']);
    }

    private function download($file) {
        //$path = \Yii::getAlias('@uploads') ;
        //$file = $path . '/some-file.pdf';

        if (file_exists($file)) {
            return \Yii::$app->response->sendFile($file);
        }
        throw new \Exception('File not found');
    }

    private function makeDir($path)
    {
        return is_dir($path) || mkdir($path, 0777, true);
    }

    private function clearDir($path, $mask='*')
    {
        if (file_exists($path)) {
            foreach (glob($path.'/'.$mask) as $file) {
                @unlink($file);
            }
        }
    }

    /**
     * Finds the PacketIn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $POS_ID
     * @param integer $PACKETNO
     * @return PacketIn the loaded model
     * @throws NotFoundHttpExceptionAlias if the model cannot be found
     */
    protected function findModel($POS_ID, $PACKETNO)
    {
        if (($model = PacketIn::findOne(['POS_ID' => $POS_ID, 'PACKETNO' => $PACKETNO])) !== null) {
            return $model;
        }

        throw new NotFoundHttpExceptionAlias(Yii::t('app', 'The requested page does not exist.'));
    }
}
