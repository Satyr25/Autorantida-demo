<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "documentos".
 *
 * @property int $id
 * @property string $nombre
 * @property int $pedidos_id
 *
 * @property Pedidos $pedidos
 */
class Documentos extends \yii\db\ActiveRecord
{
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
            [['nombre', 'pedidos_id'], 'required'],
            [['pedidos_id'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['pedidos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::className(), 'targetAttribute' => ['pedidos_id' => 'id']],
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
            'pedidos_id' => 'Pedidos ID',
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
}
