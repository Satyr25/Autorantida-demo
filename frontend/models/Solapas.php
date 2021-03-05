<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "solapas".
 *
 * @property int $id
 * @property int $tamano_id
 * @property float $precio
 */
class Solapas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'solapas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tamano_id', 'precio'], 'required'],
            [['tamano_id'], 'integer'],
            [['precio'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tamano_id' => 'Tamano ID',
            'precio' => 'Precio',
        ];
    }
}
