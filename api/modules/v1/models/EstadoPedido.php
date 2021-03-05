<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "estado_pedido".
 *
 * @property int $id
 * @property string $estado
 * @property string $clave
 *
 * @property Pedidos[] $pedidos
 */
class EstadoPedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado_pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado', 'clave'], 'required'],
            [['estado', 'clave'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estado' => 'Estado',
            'clave' => 'Clave',
        ];
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::className(), ['estado_pedido_id' => 'id']);
    }
}
