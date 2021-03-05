<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "portada_papel".
 *
 * @property int $id
 * @property int $portada_tipo_id
 * @property string $papel
 *
 * @property PapelPortada[] $papelPortadas
 * @property PortadaTipo $portadaTipo
 */
class PortadaPapel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'portada_papel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['portada_tipo_id', 'papel'], 'required'],
            [['portada_tipo_id'], 'integer'],
            [['papel'], 'string', 'max' => 45],
            [['portada_tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => PortadaTipo::className(), 'targetAttribute' => ['portada_tipo_id' => 'id']],
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
            'papel' => 'Papel',
        ];
    }

    /**
     * Gets query for [[PapelPortadas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPapelPortadas()
    {
        return $this->hasMany(PapelPortada::className(), ['portada_papel_id' => 'id']);
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
}
