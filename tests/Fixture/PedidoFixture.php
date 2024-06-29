<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PedidoFixture
 */
class PedidoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'pedido';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id_pedido' => 1,
                'usuario_id' => 1,
                'producto_id' => 1,
                'cantidad' => 1,
                'fecha_orden' => 1678382311,
                'metodo_pago' => 'Lorem ipsum dolor sit amet',
                'estado_orden' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
