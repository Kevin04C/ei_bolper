<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SubcategoriaFixture
 */
class SubcategoriaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'subcategoria';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id_subcategoria' => 1,
                'id_categoria' => 1,
                'nom_subcategoria' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
