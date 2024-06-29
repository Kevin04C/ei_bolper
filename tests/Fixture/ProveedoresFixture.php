<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProveedoresFixture
 */
class ProveedoresFixture extends TestFixture
{
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
                'usuario_id' => 1,
                'razon_social' => 'Lorem ipsum dolor sit amet',
                'nombre_comercial' => 'Lorem ipsum dolor sit amet',
                'descripcion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'telefono' => 'Lorem ipsum do',
                'correo' => 'Lorem ipsum dolor sit amet',
                'created' => '2024-06-20 16:54:36',
                'modified' => '2024-06-20 16:54:36',
            ],
        ];
        parent::init();
    }
}
