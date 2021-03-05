<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "interior_papel".
 *
 * @property int $id
 * @property string $papel
 *
 * @property PapelInterior[] $papelInteriors
 */
class InteriorPapel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'interior_papel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['papel'], 'required'],
            [['papel'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'papel' => 'Papel',
        ];
    }

    /**
     * Gets query for [[PapelInteriors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPapelInteriors()
    {
        return $this->hasMany(PapelInterior::className(), ['interior_papel_id' => 'id']);
    }
}
