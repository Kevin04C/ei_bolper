<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReseñaFixture
 */
class ReseñaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'reseña';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id_resena' => 1,
                'producto_id' => 1,
                'calidad' => 1,
                'valor' => 1,
                'nombre' => 'Lorem ipsum dolor sit amet',
                'resumen' => 'Lorem ipsum dolor sit amet',
                'revision' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'fecha_revision' => 1678382409,
            ],
        ];
        parent::init();
    }
}
