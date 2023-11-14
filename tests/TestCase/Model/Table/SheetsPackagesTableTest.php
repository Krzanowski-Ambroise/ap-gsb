<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SheetsPackagesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SheetsPackagesTable Test Case
 */
class SheetsPackagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SheetsPackagesTable
     */
    protected $SheetsPackages;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.SheetsPackages',
        'app.Sheets',
        'app.Packages',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SheetsPackages') ? [] : ['className' => SheetsPackagesTable::class];
        $this->SheetsPackages = $this->getTableLocator()->get('SheetsPackages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SheetsPackages);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SheetsPackagesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SheetsPackagesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
