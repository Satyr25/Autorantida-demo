<?php

namespace api\modules\v1\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "pedidos".
 *
 * @property int $id
 * @property string $clave
 * @property float $venta_total
 * @property int $created_at
 * @property int $updated_at
 * @property int $forma_pago_id
 * @property int $estado_pedido_id
 * @property int $clientes_id
 *
 * @property Clientes $clientes
 * @property EstadoPedido $estadoPedido
 * @property FormaPago $formaPago
 * @property PedidosSoluciones[] $pedidosSoluciones
 */
class Pedidos extends \yii\db\ActiveRecord
{
    public $numero_tarjeta;
    public $nombre_tarjeta;
    public $expira_tarjeta;
    public $seguridad_tarjeta;
    public $nombre;
    public $apellidos;
    public $correo;
    public $telefono;
    public $celular;
    public $pago_clave;
    public $tok;
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedidos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'venta_total', 'forma_pago_id', 'estado_pedido_id', 'clientes_id'], 'required'],
            [['venta_total'], 'number'],
            [['created_at', 'updated_at', 'forma_pago_id', 'estado_pedido_id', 'clientes_id', 'referencia'], 'integer'],
            [['clave'], 'string', 'max' => 10],
            [['barras', 'order_id'], 'string'],
            [['clientes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['clientes_id' => 'id']],
            [['estado_pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoPedido::className(), 'targetAttribute' => ['estado_pedido_id' => 'id']],
            [['forma_pago_id'], 'exist', 'skipOnError' => true, 'targetClass' => FormaPago::className(), 'targetAttribute' => ['forma_pago_id' => 'id']],
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
            'clave' => 'Clave',
            'venta_total' => 'Venta Total',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'forma_pago_id' => 'Forma Pago ID',
            'estado_pedido_id' => 'Estado Pedido ID',
            'clientes_id' => 'Clientes ID',
        ];
    }

    /**
     * Gets query for [[Clientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasOne(Clientes::className(), ['id' => 'clientes_id']);
    }

    /**
     * Gets query for [[EstadoPedido]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoPedido()
    {
        return $this->hasOne(EstadoPedido::className(), ['id' => 'estado_pedido_id']);
    }

    /**
     * Gets query for [[FormaPago]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFormaPago()
    {
        return $this->hasOne(FormaPago::className(), ['id' => 'forma_pago_id']);
    }

    /**
     * Gets query for [[PedidosSoluciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidosSoluciones()
    {
        return $this->hasMany(PedidosSoluciones::className(), ['pedidos_id' => 'id']);
    }

    public function crearClave(){
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
        $string = '';
        $max = strlen($chars) - 1;
        do{
            for ($i = 0; $i < 8; $i++) {
                 $string .= $chars[rand(0, $max)];
            }
            $existente = $this->find()->where(['clave' => $string])->one();
            if(!$existente){
                return $string;
            }
        }while(true);
    }
}
