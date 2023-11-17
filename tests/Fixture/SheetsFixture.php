<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SheetsFixture
 */
class SheetsFixture extends TestFixture
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
                'user_id' => 'f6adc458-c348-4fc9-b399-1d05eb8e590d',
                'state_id' => 1,
                'sheetvalidated' => 1,
                'created' => 1699970530,
                'modified' => '2023-11-14 14:02:10',
            ],
        ];
        parent::init();
    }
}
