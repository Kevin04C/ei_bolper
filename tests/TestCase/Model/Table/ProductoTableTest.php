<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductoTable Test Case
 */
class ProductoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductoTable
     */
    protected $Producto;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Producto',
        'app.DetallePedido',
        'app.Pedido',
        'app.Reseña',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Producto') ? [] : ['className' => ProductoTable::class];
        $this->Producto = $this->getTableLocator()->get('Producto', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Producto);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProductoTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
