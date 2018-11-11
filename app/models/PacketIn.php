<?php

namespace app\models;

use DateTime;
use DOMDocument;
use Yii;
use \wapmorgan\UnifiedArchive\UnifiedArchive;

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
    public static $uploadPath = '/uploads/packages/';

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
            $this->PACKETFILENAME->saveAs(self::$uploadPath . $this->PACKETFILENAME->baseName . '.' . $this->PACKETFILENAME->extension);
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

    public function zipping()
    {
        $rootPath = realpath(self::$uploadPath);

        // Initialize archive object
        $zip = new \ZipArchive();
        $zip->open('../web/descargas/Region.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Initialize empty "delete list"
        $filesToDelete = array();

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {

            // Skip directories (they would be added automatically)
            if (!$file->isDir()) {

                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);

                // Add current file to "delete list"
                // delete it later cause ZipArchive create archive only after calling close function and ZipArchive lock files until archive created)
                if ($file->getFilename() != 'important.txt') {
                    $filesToDelete[] = $filePath;
                }
            }
        }

        // Zip archive will be created only after closing object
        $zip->close();

        // Delete all files from "delete list"
        foreach ($filesToDelete as $file) {
            unlink($file);
        }

    }

    public function unzipping()
    {
        $fileName = $path = Yii::$app->basePath . self::$uploadPath . $this->PACKETFILENAME;
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
                    foreach ($rows as $row) {
                        $model = new $modelName();
                        $data = json_encode($row);
                        $data = json_decode($data, true);
                        if (isset($data['@attributes']['DATEOPEN'])) {
                            $date = DateTime::createFromFormat('Ymd\TH:i:su', $data['@attributes']['DATEOPEN']); //20180924T21:26:19000
                            $data['@attributes']['DATEOPEN'] = $date->format('Y-m-d H:i:s');
                        }
                        if (isset($data['@attributes']['DATECLOSE'])) {
                            $date = DateTime::createFromFormat('Ymd\TH:i:su', $data['@attributes']['DATECLOSE']); //20180924T21:26:19000
                            $data['@attributes']['DATECLOSE'] = $date->format('Y-m-d H:i:s');
                        }
                        $model->setAttributes($data['@attributes']);
                        if ($model->validate()) {
                            $model->save(false);
                        } else {
                            //echo \yii\helpers\Json::encode($model->getErrorSummary(true));
                            //die();
                        }
                    }
                }
                /*
                Yii::$app->db
                    ->createCommand()
                    ->batchInsert($tableName, ['column1','column2', 'column3','column4','column5'],$data)
                    ->execute();
                */

                /*
                $result = Yii::$app->db->createCommand("LOAD XML LOCAL INFILE '".Yii::$app->basePath . self::$uploadPath."tmp/SMENY_TB.xml' INTO TABLE person ROWS IDENTIFIED BY '<ROW>';");
                die($result);
                */
                //print_r($archive->getFileContent($file));
            }
        }

        return true;
    }

    public static function processingAll()
    {
        $models = PacketIn::find()->where(['PROCESSED'=>'N'])->all();
        foreach ($models as $model) {
            $model->processing();
        }
    }

    public function processing()
    {
        $fileName = Yii::$app->basePath . self::$uploadPath . $this->PACKETFILENAME;
        if (is_file($fileName)) {
            @unlink($fileName);
        }
        $fp = fopen($fileName, 'w');
        fwrite($fp, $this->DATA);
        fclose($fp);

        if ($this->unzipping()) {
            $this->save(false);
            @unlink($fileName);
        }
    }
}
