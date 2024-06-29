<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Producto Entity
 *
 * @property int $id
 * @property int $categoria_id
 * @property string $nom_producto
 * @property string $marca_producto
 * @property int $precio_producto
 * @property int $desc_producto
 * @property string $principal
 * @property string $general
 * @property string $imagen1
 * @property string $imagen2
 * @property string $imagen3
 * @property string $Estado
 * @property \Cake\I18n\FrozenTime $fecha_publicacion
 * @property string $fecha_actualizacion
 *
 * @property \App\Model\Entity\DetallePedido[] $detalle_pedido
 * @property \App\Model\Entity\Pedido[] $pedido
 * @property \App\Model\Entity\Reseña[] $reseña
 */
class Producto extends Entity
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
