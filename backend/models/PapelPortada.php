<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "papel_portada".
 *
 * @property int $id
 * @property int $portada_tipo_id
 * @property int $portada_papel_id
 * @property int $tamano_id
 * @property float $precio
 *
 * @property PortadaPapel $portadaPapel
 * @property PortadaTipo $portadaTipo
 * @property Tamano $tamano
 * @property PedidosSoluciones[] $pedidosSoluciones
 * @property SolucionesCarrito[] $solucionesCarritos
 */
class PapelPortada extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'papel_portada';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['portada_tipo_id', 'portada_papel_id', 'tamano_id', 'precio'], 'required'],
            [['portada_tipo_id', 'portada_papel_id', 'tamano_id'], 'integer'],
            [['precio'], 'number'],
            [['portada_papel_id'], 'exist', 'skipOnError' => true, 'targetClass' => PortadaPapel::className(), 'targetAttribute' => ['portada_papel_id' => 'id']],
            [['portada_tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => PortadaTipo::className(), 'targetAttribute' => ['portada_tipo_id' => 'id']],
            [['tamano_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tamano::className(), 'targetAttribute' => ['tamano_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'portada_tipo_id' => 'Portada Tipo ID',
            'portada_papel_id' => 'Portada Papel ID',
            'tamano_id' => 'Tamano ID',
            'precio' => 'Precio',
        ];
    }

    /**
     * Gets query for [[PortadaPapel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortadaPapel()
    {
        return $this->hasOne(PortadaPapel::className(), ['id' => 'portada_papel_id']);
    }

    /**
     * Gets query for [[PortadaTipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortadaTipo()
    {
        return $this->hasOne(PortadaTipo::className(), ['id' => 'portada_tipo_id']);
    }

    /**
     * Gets query for [[Tamano]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTamano()
    {
        return $this->hasOne(Tamano::className(), ['id' => 'tamano_id']);
    }

    /**
     * Gets query for [[PedidosSoluciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidosSoluciones()
    {
        return $this->hasMany(PedidosSoluciones::className(), ['papel_portada_id' => 'id']);
    }

    /**
     * Gets query for [[SolucionesCarritos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolucionesCarritos()
    {
        return $this->hasMany(SolucionesCarrito::className(), ['papel_portada_id' => 'id']);
    }
}
