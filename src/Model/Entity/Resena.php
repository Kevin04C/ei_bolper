<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Resena Entity
 *
 * @property int $id_resena
 * @property int $producto_id
 * @property int $calidad
 * @property int $valor
 * @property string $nombre
 * @property string $resumen
 * @property string $revision
 * @property \Cake\I18n\FrozenTime $fecha_revision
 *
 * @property \App\Model\Entity\Producto $producto
 */
class Resena extends Entity
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
