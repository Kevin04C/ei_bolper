<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductoFixture
 */
class ProductoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'producto';
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
                'categoria_id' => 1,
                'nom_producto' => 'Lorem ipsum dolor sit amet',
                'marca_producto' => 'Lorem ipsum dolor sit amet',
                'precio_producto' => 1,
                'desc_producto' => 1,
                'principal' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'general' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'imagen1' => 'Lorem ipsum dolor sit amet',
                'imagen2' => 'Lorem ipsum dolor sit amet',
                'imagen3' => 'Lorem ipsum dolor sit amet',
                'Estado' => 'Lorem ipsum dolor sit amet',
                'fecha_publicacion' => 1678371739,
                'fecha_actualizacion' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
