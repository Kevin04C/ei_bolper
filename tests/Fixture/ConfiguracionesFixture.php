<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ConfiguracionesFixture
 */
class ConfiguracionesFixture extends TestFixture
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
                'varname' => 'Lorem ipsum dolor sit amet',
                'varvalue' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
