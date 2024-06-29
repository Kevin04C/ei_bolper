<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsuarioFixture
 */
class UsuarioFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'usuario';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id_usuario' => 1,
                'nom_usuario' => 'Lorem ipsum dolor sit amet',
                'correo_usuario' => 'Lorem ipsum dolor sit amet',
                'telef_usuario' => 1,
                'contrasena' => 'Lorem ipsum dolor ',
                'direccion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'departamento' => 'Lorem ipsum dolor sit amet',
                'codigo_postal' => 1,
                'tipo' => 'Lorem ipsum do',
                'created' => '2023-03-22 13:47:02',
                'modified' => '2023-03-22 13:47:02',
            ],
        ];
        parent::init();
    }
}
