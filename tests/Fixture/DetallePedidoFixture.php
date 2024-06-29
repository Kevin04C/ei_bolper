<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DetallePedidoFixture
 */
class DetallePedidoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'detalle_pedido';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'pedido_id' => 1,
                'producto_id' => 1,
                'pedido_cantidad' => 1,
                'producto_nombre' => 'Lorem ipsum dolor sit amet',
                'producto_punitarioincigv' => 1,
                'producto_subtotal' => 1,
                'pedido_igv' => 1,
                'producto_total' => 1,
                'created' => '2023-03-09 17:15:54',
                'modified' => '2023-03-09 17:15:54',
            ],
        ];
        parent::init();
    }
}
