<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PedidoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PedidoTable Test Case
 */
class PedidoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PedidoTable
     */
    protected $Pedido;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Pedido',
        'app.Usuario',
        'app.Producto',
        'app.DetallePedido',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Pedido') ? [] : ['className' => PedidoTable::class];
        $this->Pedido = $this->getTableLocator()->get('Pedido', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Pedido);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PedidoTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PedidoTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
