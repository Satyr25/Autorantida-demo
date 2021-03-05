<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pedidos_soluciones".
 *
 * @property int $id
 * @property int $pedidos_id
 * @property int $soluciones_id
 * @property int $cantidad
 *
 * @property Pedidos $pedidos
 * @property Soluciones $soluciones
 */
class PedidosSoluciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedidos_soluciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pedidos_id', 'soluciones_id', 'cantidad'], 'required'],
            [['pedidos_id', 'soluciones_id', 'cantidad'], 'integer'],
            [['pedidos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::className(), 'targetAttribute' => ['pedidos_id' => 'id']],
            [['soluciones_id'], 'exist', 'skipOnError' => true, 'targetClass' => Soluciones::className(), 'targetAttribute' => ['soluciones_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pedidos_id' => 'Pedidos ID',
            'soluciones_id' => 'Soluciones ID',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasOne(Pedidos::className(), ['id' => 'pedidos_id']);
    }

    /**
     * Gets query for [[Soluciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoluciones()
    {
        return $this->hasOne(Soluciones::className(), ['id' => 'soluciones_id']);
    }
}
