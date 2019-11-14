<?php

namespace app\models;

use wapmorgan\UnifiedArchive\UnifiedArchive;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use yii\helpers\Html;
use ZipArchive;
use Yii;

/**
 * This is the model class for table "MGTPACKETS".
 *
 * @property int $POS_ID
 * @property int $DEST_POS_ID
 * @property int $PACKETNO
 * @property string $PACKETFILENAME
 * @property resource $DATA
 */
class Packet extends ActiveRecord
{
    public static $uploadPath = '/uploads/packages_out';
    public static $exportList = [
        'bpos' => 'app\models\Bpos',
        'work' => 'app\models\Work',
        'tovar_type' => 'app\models\TovarType',
        'personal' => 'app\models\Personal',
        'tovar' => 'app\models\Tovar',
    ];

    public static $exportDependenceList = [
        'tovar_price' => 'app\models\TovarPrice',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'MGTPACKETS';
    }

    public static function getExportTables()
    {
        return self::$exportList;

        /*
        $list = null;
        foreach (self::$exportList as $key => $modelName) {
            $cnt = $modelName::find()
                ->where(['PUBLISHED'=>ActiveRecord::$valuePublishedU])
                ->count();
            if ($cnt>0) {
                $list[$key] = $modelName;
            }
        }

        return $list;
        */
    }

    public static function getExportDependenceTables($bposId=null)
    {
        return self::$exportDependenceList;

        /*
        $list = null;
        foreach (self::$exportDependenceList as $key => $modelName) {
            $cnt = $modelName::find()
                ->where(['PUBLISHED'=>ActiveRecord::$valuePublishedU, 'POS_ID'=>$bposId])
                ->count();
            if ($cnt>0) {
                $list[$key] = $modelName;
            }
        }

        return $list;
        */
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['POS_ID', 'DEST_POS_ID', 'PACKETNO'], 'required'],
            [['POS_ID', 'DEST_POS_ID', 'PACKETNO'], 'integer'],
            [['DATA'], 'string'],
            [['PACKETFILENAME'], 'string', 'max' => 25],
            [['POS_ID', 'DEST_POS_ID', 'PACKETNO'], 'unique', 'targetAttribute' => ['POS_ID', 'DEST_POS_ID', 'PACKETNO']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'POS_ID' => Yii::t('app', 'Точка продаж'),
            'DEST_POS_ID' => Yii::t('app', 'Точка продаж'),
            'PACKETNO' => Yii::t('app', 'Номер пакета'),
            'PACKETFILENAME' => Yii::t('app', 'Имя пакета'),
            'DATA' => Yii::t('app', 'Данные'),
        ];
    }
    public static function getBposFilter($searchModel, $idSmenaSelector=null)
    {
        return Html::activeDropDownList(
            $searchModel,
            'DEST_POS_ID',
            Bpos::getBposList(),
            [
                'class'=>'form-control',
                'prompt' => 'Все',
                /*
                'onchange' => is_null($idSmenaSelector) ? null : '
				    $.post( "'.Yii::$app->urlManager->createUrl('admin/operation/smena-lists?pos_id=').'"+$(this).val(), function( data ) {
				        $( "select#'.$idSmenaSelector.'" ).html( data );
				    });
			    '
                */
            ]
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBpos()
    {
        return $this->hasOne(Bpos::className(), ['POS_ID' => 'DEST_POS_ID']);
    }

    public function zipping($path, $fileName)
    {

        return UnifiedArchive::archiveFiles($path, $fileName, false);
        //print_r($cnt);
        //die($fileName );

        $rootPath = realpath($path);

        // Create recursive directory iterator
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        // Initialize archive object
        $zip = new \ZipArchive();
        $zip->open($fileName, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Initialize empty "delete list"
        $filesToDelete = array();

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
}
