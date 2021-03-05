<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "portada_tipo".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property PapelPortada[] $papelPortadas
 * @property PortadaPapel[] $portadaPapels
 */
class PortadaTipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'portada_tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * Gets query for [[PapelPortadas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPapelPortadas()
    {
        return $this->hasMany(PapelPortada::className(), ['portada_tipo_id' => 'id']);
    }

    /**
     * Gets query for [[PortadaPapels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortadaPapels()
    {
        return $this->hasMany(PortadaPapel::className(), ['portada_tipo_id' => 'id']);
    }
}
