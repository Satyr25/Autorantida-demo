<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "blogs".
 *
 * @property int $id
 * @property string $titulo
 * @property string $autor
 * @property string $tema
 * @property string $resumen
 * @property string $imagen
 * @property string $texto
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int $activo
 */
class Blogs extends \yii\db\ActiveRecord
{
        
//    public $id;
//    public $titulo;
//    public $autor;
//    public $tema;
//    public $resumen;
//    public $imagen;
//    public $texto;
//    public $created_at;
//    public $updated_at;
//    public $activo;
    public $archivo;
//    public $nombre;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blogs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'autor', 'tema', 'resumen', 'imagen', 'texto'], 'required'],
            [['resumen', 'texto'], 'string'],
            [['created_at', 'activo'], 'integer'],
            [['titulo', 'autor', 'tema', 'imagen'], 'string', 'max' => 255],
        ];
    }

    public function behaviors(){
        return [
            // TimestampBehavior::className(),
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'autor' => 'Autor',
            'tema' => 'Tema',
            'resumen' => 'Resumen',
            'imagen' => 'Imagen',
            'texto' => 'Texto',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'activo' => 'Activar',
        ];
    }
        
    public function guardar($blogForm){
        
        return $this->guardaArchivo('archivo');
    }

    public function guardaArchivo($archivo){
        if (!UploadedFile::getInstance($this, $archivo)){
            return false;
        }
        $this->archivo = UploadedFile::getInstance($this, $archivo);
        $ruta = Yii::getAlias('@backend/web/').preg_replace("/[^a-z0-9\.]/", "", "blog");
        $ruta_frontend = Yii::getAlias('@frontend/web/').preg_replace("/[^a-z0-9\.]/", "", "blog");
        if(!file_exists($ruta)){
            if(!mkdir($ruta)){
                return false;
            }
        }
        if(!file_exists($ruta_frontend)){
            if(!mkdir($ruta_frontend)){
                return false;
            }
        }
        $guardado = false;
        while(!$guardado){
            $timestamp = time();
            $nombre_archivo = $timestamp.preg_replace("/[^a-z0-9\.]/", "", strtolower($this->$archivo));
            if(!file_exists($ruta.'/'.$nombre_archivo)){
                if(!$this->archivo->saveAs($ruta.'/'.$nombre_archivo, false )){
                    return false;
                }
                if(!$this->archivo->saveAs($ruta_frontend.'/'.$nombre_archivo, false )){
                    return false;
                }
             $guardado = true;
             }
        }
        return $nombre_archivo;
    }
}
