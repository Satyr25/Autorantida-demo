<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "interior_color".
 *
 * @property int $id
 * @property string|null $tipo
 *
 * @property PapelInterior[] $papelInteriors
 */
class InteriorColor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'interior_color';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
     * Gets query for [[PapelInteriors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPapelInteriors()
    {
        return $this->hasMany(PapelInterior::className(), ['interior_color_id' => 'id']);
    }
}
