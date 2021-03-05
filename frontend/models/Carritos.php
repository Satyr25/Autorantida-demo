<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "carritos".
 *
 * @property int $id
 * @property string $cookie
 * @property int $created_at
 * @property int|null $updated_at
 * @property float|null $total
 *
 * @property SolucionesCarrito[] $solucionesCarritos
 */
class Carritos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carritos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cookie'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['total'], 'number'],
            [['cookie'], 'string', 'max' => 255],
        ];
    }
    
    public function behaviors(){
        return [
            // TimestampBehavior::className(),
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cookie' => 'Cookie',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'total' => 'Total',
        ];
    }

    /**
     * Gets query for [[SolucionesCarritos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolucionesCarritos()
    {
        return $this->hasMany(SolucionesCarrito::className(), ['carritos_id' => 'id']);
    }
}
