<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "soluciones_carrito".
 *
 * @property int $id
 * @property int $carritos_id
 * @property int $soluciones_id
 * @property int $cantidad
 * @property int|null $papel_interior_id
 * @property int|null $papel_portada_id
 * @property int|null $retractil_id
 * @property int|null $solapas_id
 * @property int|null $tiraje
 *
 * @property Carritos $carritos
 * @property Soluciones $soluciones
 * @property PapelInterior $papelInterior
 * @property PapelPortada $papelPortada
 * @property Retractil $retractil
 * @property Solapas $solapas
 */
class SolucionesCarrito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'soluciones_carrito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['carritos_id', 'soluciones_id', 'cantidad'], 'required'],
            [['carritos_id', 'soluciones_id', 'cantidad', 'papel_interior_id', 'papel_portada_id', 'retractil_id', 'solapas_id', 'tiraje'], 'integer'],
            [['carritos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carritos::className(), 'targetAttribute' => ['carritos_id' => 'id']],
            [['soluciones_id'], 'exist', 'skipOnError' => true, 'targetClass' => Soluciones::className(), 'targetAttribute' => ['soluciones_id' => 'id']],
            [['papel_interior_id'], 'exist', 'skipOnError' => true, 'targetClass' => PapelInterior::className(), 'targetAttribute' => ['papel_interior_id' => 'id']],
            [['papel_portada_id'], 'exist', 'skipOnError' => true, 'targetClass' => PapelPortada::className(), 'targetAttribute' => ['papel_portada_id' => 'id']],
            [['retractil_id'], 'exist', 'skipOnError' => true, 'targetClass' => Retractil::className(), 'targetAttribute' => ['retractil_id' => 'id']],
            [['solapas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Solapas::className(), 'targetAttribute' => ['solapas_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'carritos_id' => 'Carritos ID',
            'soluciones_id' => 'Soluciones ID',
            'cantidad' => 'Cantidad',
            'papel_interior_id' => 'Papel Interior ID',
            'papel_portada_id' => 'Papel Portada ID',
            'retractil_id' => 'Retractil ID',
            'solapas_id' => 'Solapas ID',
            'tiraje' => 'Tiraje',
        ];
    }

    /**
     * Gets query for [[Carritos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarritos()
    {
        return $this->hasOne(Carritos::className(), ['id' => 'carritos_id']);
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

    /**
     * Gets query for [[PapelInterior]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPapelInterior()
    {
        return $this->hasOne(PapelInterior::className(), ['id' => 'papel_interior_id']);
    }

    /**
     * Gets query for [[PapelPortada]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPapelPortada()
    {
        return $this->hasOne(PapelPortada::className(), ['id' => 'papel_portada_id']);
    }

    /**
     * Gets query for [[Retractil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRetractil()
    {
        return $this->hasOne(Retractil::className(), ['id' => 'retractil_id']);
    }

    /**
     * Gets query for [[Solapas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolapas()
    {
        return $this->hasOne(Solapas::className(), ['id' => 'solapas_id']);
    }
}
