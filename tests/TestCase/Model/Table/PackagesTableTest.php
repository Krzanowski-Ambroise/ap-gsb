<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PackagesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PackagesTable Test Case
 */
class PackagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PackagesTable
     */
    protected $Packages;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Packages',
        'app.Sheets',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Packages') ? [] : ['className' => PackagesTable::class];
        $this->Packages = $this->getTableLocator()->get('Packages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Packages);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PackagesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
