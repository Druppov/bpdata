<?php

namespace app\models;

use DateTime;
use DOMDocument;
use Throwable;
use Yii;
use \wapmorgan\UnifiedArchive\UnifiedArchive;
use yii\helpers\Json;

/**
 * This is the model class for table "MGTPACKETS_IN".
 *
 * @property int $POS_ID
 * @property int $PACKETNO
 * @property string $PACKETFILENAME
 * @property resource $DATA
 * @property string $PROCESSED
 */
class PacketIn extends ActiveRecord
{
    public static $downloadPath = '\uploads\packages_in\\';

    public $created_at;
    public $updated_at;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'MGTPACKETS_IN';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'PACKETNO'], 'required'],
            [['POS_ID', 'PACKETNO'], 'integer'],
            [['DATA'], 'string'],
            //[['DATA'], 'safe'],
            [['DATA'], 'file', 'extensions'=>'zip, rar'],
            [['DATA'], 'file', 'maxSize'=>'1000000'],
            //[['PACKETFILENAME'], 'string', 'max' => 25],
            [['PROCESSED'], 'string', 'max' => 1],
            [['POS_ID', 'PACKETNO'], 'unique', 'targetAttribute' => ['POS_ID', 'PACKETNO']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'POS_ID' => Yii::t('app', 'Точка продаж'),
            'PACKETNO' => Yii::t('app', 'Номер пакета'),
            'PACKETFILENAME' => Yii::t('app', 'Имя пакета'),
            'DATA' => Yii::t('app', 'Данные'),
            'PROCESSED' => Yii::t('app', 'Обработан'),
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->PACKETFILENAME->saveAs(self::$downloadPath . $this->PACKETFILENAME->baseName . '.' . $this->PACKETFILENAME->extension);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBpos()
    {
        return $this->hasOne(Bpos::className(), ['POS_ID' => 'POS_ID']);
    }

    public function unzipping()
    {
        $errors = null;

        $fileName = $path = Yii::$app->basePath . self::$downloadPath . $this->PACKETFILENAME;
        $archive = UnifiedArchive::open($fileName);
        $files = $archive->getFileNames();
        foreach ($files as $file) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $tableName = pathinfo($file, PATHINFO_FILENAME);
            if ($ext=='xml') {
                $fileContent = $archive->getFileContent($file);

                $xml = simplexml_load_string($fileContent);
                $rows = $xml->xpath("ROWDATA/ROW");
                unset($data);
                switch ($tableName) {
                    case 'BALANCES':
                        $modelName = 'app\models\Balance';
                        break;
                    case 'PAYCHECKS':
                        $modelName = 'app\models\PayCheck';
                        break;
                    case 'PAYCHECKS_TB':
                        $modelName = 'app\models\PayCheckTb';
                        break;
                    case 'PCHECKS_INTL':
                        $modelName = 'app\models\PayCheckIntl';
                        break;
                    case 'PCHECKS_INTL_TB':
                        $modelName = 'app\models\PayCheckIntlTb';
                        break;
                    case 'SMENY':
                        $modelName = 'app\models\Smena';
                        break;
                    case 'SMENY_TB':
                        $modelName = 'app\models\SmenaTb';
                        break;
                    default:
                        $modelName = null;
                }

                if (!is_null($modelName)) {
                    //$transaction = $modelName::getDb()->beginTransaction();
                    if ($modelName == 'app\models\PayCheck') {
                        Yii::info("В таблицу : ".$modelName. " добавлена запись:");
                    }
                    try {
                        $isSuccessfull = true;
                        foreach ($rows as $row) {
                            $data = json_encode($row);
                            $data = json_decode($data, true);
                            //DATEOPEN
                            if (isset($data['@attributes']['DATEOPEN'])) {
                                $date = DateTime::createFromFormat('Ymd\TH:i:su', $data['@attributes']['DATEOPEN']); //20180924T21:26:19000
                                $data['@attributes']['DATEOPEN'] = $date->format('Y-m-d H:i:s');
                            }
                            //DATECLOSE
                            if (isset($data['@attributes']['DATECLOSE'])) {
                                $date = DateTime::createFromFormat('Ymd\TH:i:su', $data['@attributes']['DATECLOSE']); //20180924T21:26:19000
                                $data['@attributes']['DATECLOSE'] = $date->format('Y-m-d H:i:s');
                            }
                            //STAMP
                            if (isset($data['@attributes']['STAMP'])) {
                                $date = DateTime::createFromFormat('Ymd\TH:i:su', $data['@attributes']['STAMP']); //20180924T21:26:19000
                                $data['@attributes']['STAMP'] = $date->format('Y-m-d H:i:s');
                            }
                            //BALANCEDATE
                            if (isset($data['@attributes']['BALANCEDATE'])) {
                                $date = DateTime::createFromFormat('Ymd', $data['@attributes']['BALANCEDATE']); //20190403
                                $data['@attributes']['BALANCEDATE'] = $date->format('Y-m-d');
                            }
                            //TIME_START="08:30:00000"
                            if (isset($data['@attributes']['TIME_START'])) {
                                $date = DateTime::createFromFormat('H:i:su', $data['@attributes']['TIME_START']); //20190403
                                $data['@attributes']['TIME_START'] = $date->format('H:i:s');
                            }
                            //TIME_END="21:30:00000"
                            if (isset($data['@attributes']['TIME_END'])) {
                                $date = DateTime::createFromFormat('H:i:su', $data['@attributes']['TIME_END']); //20190403
                                $data['@attributes']['TIME_END'] = $date->format('H:i:s');
                            }
                            if (isset($data['@attributes']['PUBLISHED'])) {
                                $data['@attributes']['PUBLISHED'] = 'P';
                            }

                            $model = false;
                            $primaryKeys = $modelName::primaryKey();
                            if (isset($primaryKeys) && is_array($primaryKeys)) {
                                unset($params);
                                foreach ($primaryKeys as $primaryKey) {
                                    $params[$primaryKey] = $data['@attributes'][$primaryKey];
                                }
                                $model = $modelName::findOne($params);
                            }
                            /*
                            if ($tableName=='SMENY') {
                                $model = $modelName::findOne([
                                    'POS_ID' => $data['@attributes']['POS_ID'],
                                    'SMENA_ID' => $data['@attributes']['SMENA_ID'],
                                ]);
                            } elseif ($tableName=='SMENY_TB') {
                                $model = $modelName::findOne([
                                    'POS_ID' => $data['@attributes']['POS_ID'],
                                    'SMENA_ID' => $data['@attributes']['SMENA_ID'],
                                    'PERSON_ID' => $data['@attributes']['PERSON_ID'],
                                ]);
                            }
                            */
                            if (!$model) {
                                $model = new $modelName();
                                Yii::info("В таблицу : ".$modelName. " добавлена запись:");
                            } else {
                                Yii::info("В таблице : ".$modelName. " обновлена запись:");
                            }
                            Yii::info(Json::encode($data['@attributes']));

                            $model->setAttributes($data['@attributes']);
                            if ($model->validate()) {
                                $model->save(false);
                                Yii::info("успешно");
                                //$transaction->commit();
                            } else {
                                $isSuccessfull = false;
                                $errors[] = $model->getErrors();
                                Yii::error('!!! с ошибкой: ' . Json::encode($model->getErrors()));
                                //$transaction->rollBack();
                            }
                        }
                        /*
                        if ($isSuccessfull) {
                            $transaction->commit();
                        } else {
                            $transaction->rollBack();
                        }
                        */
                    } catch(Throwable $e) {
                        //$transaction->rollBack();
                        throw $e;
                    }
                }

            }
        }

        return is_null($errors) ? true : $errors;
    }

    public static function processingAll()
    {
        $errors = null;

        $models = PacketIn::find()->where(['PROCESSED'=>PacketIn::$valueNo])->all();
        foreach ($models as $model) {
            if ($result = $model->processing()) {
                $model->PROCESSED = PacketIn::$valueYes;
                $model->save(false);
            } else {
                $errors[] = $result;
            }
        }

        return is_null($errors) ? true : $errors;
    }

    public function copyPackage()
    {
        $fileName = Yii::$app->basePath . self::$downloadPath . $this->PACKETFILENAME;
        if (is_file($fileName)) {
            @unlink($fileName);
        }
        $fp = fopen($fileName, 'w');
        fwrite($fp, $this->DATA);
        fclose($fp);
    }

    public function processing()
    {
        $fileName = Yii::$app->basePath . self::$downloadPath . $this->PACKETFILENAME;
        if (is_file($fileName)) {
            @unlink($fileName);
        }
        $fp = fopen($fileName, 'w');
        fwrite($fp, $this->DATA);
        fclose($fp);

        $result = $this->unzipping();
        $this->save(false);
        @unlink($fileName);

        return $result;
    }
}
