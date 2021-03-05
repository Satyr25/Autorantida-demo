<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "blogs".
 *
 * @property int $id
 * @property string $titulo
 * @property string $autor
 * @property string $tema
 * @property string $resumen
 * @property string $imagen
 * @property string $texto
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int $activo
 */
class Blogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blogs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'autor', 'tema', 'resumen', 'imagen', 'texto'], 'required'],
            [['resumen', 'texto'], 'string'],
            [['created_at', 'updated_at', 'activo'], 'integer'],
            [['titulo', 'autor', 'tema', 'imagen'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'autor' => 'Autor',
            'tema' => 'Tema',
            'resumen' => 'Resumen',
            'imagen' => 'Imagen',
            'texto' => 'Texto',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'activo' => 'Activo',
        ];
    }
}
