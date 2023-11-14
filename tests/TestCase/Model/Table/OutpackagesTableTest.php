<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OutpackagesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OutpackagesTable Test Case
 */
class OutpackagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OutpackagesTable
     */
    protected $Outpackages;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Outpackages',
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
        $config = $this->getTableLocator()->exists('Outpackages') ? [] : ['className' => OutpackagesTable::class];
        $this->Outpackages = $this->getTableLocator()->get('Outpackages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Outpackages);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OutpackagesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
