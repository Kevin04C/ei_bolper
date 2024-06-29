<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FavoritoFixture
 */
class FavoritoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'favorito';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id_favorito' => 1,
                'usuario_id' => 1,
                'producto_id' => 1,
                'fecha_publicacion' => 1678382172,
            ],
        ];
        parent::init();
    }
}
