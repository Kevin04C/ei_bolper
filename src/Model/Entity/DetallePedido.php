<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DetallePedido Entity
 *
 * @property int $id
 * @property int|null $pedido_id
 * @property int|null $producto_id
 * @property float|null $pedido_cantidad
 * @property string|null $producto_nombre
 * @property float|null $producto_punitarioincigv
 * @property float|null $producto_subtotal
 * @property float|null $pedido_igv
 * @property float|null $producto_total
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class DetallePedido extends Entity
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
