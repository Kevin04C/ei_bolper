<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubcategoriaTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubcategoriaTable Test Case
 */
class SubcategoriaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SubcategoriaTable
     */
    protected $Subcategoria;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Subcategoria',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Subcategoria') ? [] : ['className' => SubcategoriaTable::class];
        $this->Subcategoria = $this->getTableLocator()->get('Subcategoria', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Subcategoria);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SubcategoriaTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
