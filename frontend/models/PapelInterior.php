<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "papel_interior".
 *
 * @property int $id
 * @property int $interior_color_id
 * @property int $interior_papel_id
 * @property int $interior_gramaje_id
 * @property int $tamano_id
 * @property float $precio
 *
 * @property InteriorColor $interiorColor
 * @property InteriorGramaje $interiorGramaje
 * @property InteriorPapel $interiorPapel
 * @property Tamano $tamano
 * @property PedidosSoluciones[] $pedidosSoluciones
 * @property SolucionesCarrito[] $solucionesCarritos
 */
class PapelInterior extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'papel_interior';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['interior_color_id', 'interior_papel_id', 'interior_gramaje_id', 'tamano_id', 'precio'], 'required'],
            [['interior_color_id', 'interior_papel_id', 'interior_gramaje_id', 'tamano_id'], 'integer'],
            [['precio'], 'number'],
            [['interior_color_id'], 'exist', 'skipOnError' => true, 'targetClass' => InteriorColor::className(), 'targetAttribute' => ['interior_color_id' => 'id']],
            [['interior_gramaje_id'], 'exist', 'skipOnError' => true, 'targetClass' => InteriorGramaje::className(), 'targetAttribute' => ['interior_gramaje_id' => 'id']],
            [['interior_papel_id'], 'exist', 'skipOnError' => true, 'targetClass' => InteriorPapel::className(), 'targetAttribute' => ['interior_papel_id' => 'id']],
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
            'interior_color_id' => 'Interior Color ID',
            'interior_papel_id' => 'Interior Papel ID',
            'interior_gramaje_id' => 'Interior Gramaje ID',
            'tamano_id' => 'Tamano ID',
            'precio' => 'Precio',
        ];
    }

    /**
     * Gets query for [[InteriorColor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInteriorColor()
    {
        return $this->hasOne(InteriorColor::className(), ['id' => 'interior_color_id']);
    }

    /**
     * Gets query for [[InteriorGramaje]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInteriorGramaje()
    {
        return $this->hasOne(InteriorGramaje::className(), ['id' => 'interior_gramaje_id']);
    }

    /**
     * Gets query for [[InteriorPapel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInteriorPapel()
    {
        return $this->hasOne(InteriorPapel::className(), ['id' => 'interior_papel_id']);
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
        return $this->hasMany(PedidosSoluciones::className(), ['papel_interior_id' => 'id']);
    }

    /**
     * Gets query for [[SolucionesCarritos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolucionesCarritos()
    {
        return $this->hasMany(SolucionesCarrito::className(), ['papel_interior_id' => 'id']);
    }
}
