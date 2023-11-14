<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SheetsPackagesFixture
 */
class SheetsPackagesFixture extends TestFixture
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
                'sheet_id' => 1,
                'package_id' => 1,
                'quantity' => 1,
            ],
        ];
        parent::init();
    }
}
