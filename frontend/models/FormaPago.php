<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "forma_pago".
 *
 * @property int $id
 * @property string $forma_pago
 * @property string $clave
 *
 * @property Pedidos[] $pedidos
 */
class FormaPago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'forma_pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['forma_pago', 'clave'], 'required'],
            [['forma_pago'], 'string', 'max' => 255],
            [['clave'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'forma_pago' => 'Forma Pago',
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
        return $this->hasMany(Pedidos::className(), ['forma_pago_id' => 'id']);
    }
}
