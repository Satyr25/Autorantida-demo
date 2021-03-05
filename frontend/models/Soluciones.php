<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "soluciones".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $unidad
 * @property float $precio
 */
class Soluciones extends \yii\db\ActiveRecord
{
    
    public $interior_papel;
    public $interior_color;
    public $portada_tipo;
    public $portada_papel;
    public $solapas;
    public $retractil;
    public $tiraje;
    public $tamano;
    public $cantidad;
    
//    public $clave;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'soluciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'unidad', 'precio', 'clave'], 'required'],
            [['descripcion'], 'string'],
            [['precio'], 'number'],
            [['nombre'], 'string', 'max' => 255],
            [['unidad'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'unidad' => 'Unidad',
            'precio' => 'Precio',
        ];
    }
}
