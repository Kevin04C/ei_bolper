<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FavoritoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FavoritoTable Test Case
 */
class FavoritoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FavoritoTable
     */
    protected $Favorito;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Favorito',
        'app.Usuario',
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
        $config = $this->getTableLocator()->exists('Favorito') ? [] : ['className' => FavoritoTable::class];
        $this->Favorito = $this->getTableLocator()->get('Favorito', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Favorito);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FavoritoTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FavoritoTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
