<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pedido Entity
 *
 * @property int $id_pedido
 * @property int $usuario_id
 * @property int $producto_id
 * @property int $cantidad
 * @property \Cake\I18n\FrozenTime $fecha_orden
 * @property string $metodo_pago
 * @property string $estado_orden
 *
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Producto $producto
 * @property \App\Model\Entity\DetallePedido[] $detalle_pedido
 */
class Pedido extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        '*' => true,
    ];
}
