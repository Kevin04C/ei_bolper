<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReseñaTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReseñaTable Test Case
 */
class ReseñaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReseñaTable
     */
    protected $Reseña;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Reseña',
        'app.Producto',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Reseña') ? [] : ['className' => ReseñaTable::class];
        $this->Reseña = $this->getTableLocator()->get('Reseña', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Reseña);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ReseñaTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ReseñaTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
