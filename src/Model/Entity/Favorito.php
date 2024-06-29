<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Favorito Entity
 *
 * @property int $id_favorito
 * @property int $usuario_id
 * @property int $producto_id
 * @property \Cake\I18n\FrozenTime $fecha_publicacion
 *
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Producto $producto
 */
class Favorito extends Entity
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
        'usuario_id' => true,
        'producto_id' => true,
        'fecha_publicacion' => true,
        'usuario' => true,
        'producto' => true,
    ];
}
