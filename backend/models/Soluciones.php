<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "soluciones".
 *
 * @property int $id
 * @property string $clave
 * @property string $nombre
 * @property string $descripcion
 * @property string $unidad
 * @property float $precio
 *
 * @property PedidosSoluciones[] $pedidosSoluciones
 * @property SolucionesCarrito[] $solucionesCarritos
 */
class Soluciones extends \yii\db\ActiveRecord
{
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
            [['clave', 'nombre', 'descripcion', 'unidad', 'precio'], 'required'],
            [['descripcion'], 'string'],
            [['precio'], 'number'],
            [['clave', 'unidad'], 'string', 'max' => 45],
            [['nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clave' => 'Clave',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'unidad' => 'Unidad',
            'precio' => 'Precio',
        ];
    }

    /**
     * Gets query for [[PedidosSoluciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidosSoluciones()
    {
        return $this->hasMany(PedidosSoluciones::className(), ['soluciones_id' => 'id']);
    }

    /**
     * Gets query for [[SolucionesCarritos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolucionesCarritos()
    {
        return $this->hasMany(SolucionesCarrito::className(), ['soluciones_id' => 'id']);
    }
}
