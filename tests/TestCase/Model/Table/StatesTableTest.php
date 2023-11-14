<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatesTable Test Case
 */
class StatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StatesTable
     */
    protected $States;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.States',
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
        $config = $this->getTableLocator()->exists('States') ? [] : ['className' => StatesTable::class];
        $this->States = $this->getTableLocator()->get('States', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->States);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\StatesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
