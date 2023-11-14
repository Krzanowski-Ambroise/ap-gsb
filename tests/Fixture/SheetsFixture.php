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
                'user_id' => 'd1203d91-ee52-4064-baeb-b688463c3b3f',
                'state_id' => 1,
                'sheetvalidated' => 1,
                'created' => '2023-11-14 10:29:24',
                'modified' => '2023-11-14 10:29:24',
            ],
        ];
        parent::init();
    }
}
