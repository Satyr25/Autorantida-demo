<?php

namespace backend\models;

use Yii;
use yii\helpers\Url;
use yii\base\Model;
use yii\web\UploadedFile;
use frontend\models\Blogs;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "documentos".
 *
 * @property int $id
 * @property string $nombre
 * @property string $formato
 * @property int $pedidos_id
 *
 * @property Pedidos $pedidos
 */
class BlogsForm extends Model
{
    private $transaction;
    
    public $id;
    public $titulo;
    public $autor;
    public $tema;
    public $resumen;
    public $imagen;
    public $texto;
//    public $created_at;
//    public $updated_at;
    public $activo;
    public $archivo;
    public $nombre;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'autor', 'tema', 'resumen', 'imagen', 'texto', 'archivo'], 'required'],
            [['resumen', 'texto'], 'string'],
            [['activo'], 'integer'],
            [['titulo', 'autor', 'tema', 'imagen'], 'string', 'max' => 255],
            [['archivo'],'file', 'extensions' => 'png, jpg'],
        ];
    }
//    
//    public function behaviors(){
//        return [
//            // TimestampBehavior::className(),
//            [
//                'class' => TimestampBehavior::className(),
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
//                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
//                ],
//            ],
//        ];
//    }

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

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    
    public function guardar($blogForm){
        $blogF = $blogForm['BlogsForm'];
//        var_dump($blog);exit;
        $nombre = $this->guardaArchivo('archivo');
//        var_dump($nombre);exit;
        $blog = new Blogs();
        $blog->titulo = $blogF['titulo']; 
        $blog->autor = $blogF['autor'];
        $blog->tema = $blogF['tema']; 
        $blog->resumen = $blogF['resumen']; 
        $blog->imagen = $nombre; 
        $blog->texto = $blogF['texto']; 
        $blog->activo = $blogF['activo'];
//        var_dump($blog);exit;
        if (!$blog->save()) {
            var_dump($blog->errors);exit;
            return false;
        }
        
        return true;
    }

    public function guardaArchivo($archivo){
        if (!UploadedFile::getInstance($this, $archivo)){
            return null;
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
