<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tamano".
 *
 * @property int $id
 * @property string $tamano
 *
 * @property PapelInterior[] $papelInteriors
 * @property PapelPortada[] $papelPortadas
 */
class Tamano extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tamano';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tamano'], 'required'],
            [['tamano'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tamano' => 'Tamano',
        ];
    }

    /**
     * Gets query for [[PapelInteriors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPapelInteriors()
    {
        return $this->hasMany(PapelInterior::className(), ['tamano_id' => 'id']);
    }

    /**
     * Gets query for [[PapelPortadas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPapelPortadas()
    {
        return $this->hasMany(PapelPortada::className(), ['tamano_id' => 'id']);
    }
}
