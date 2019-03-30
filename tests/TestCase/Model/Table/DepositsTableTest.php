<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepositsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepositsTable Test Case
 */
class DepositsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DepositsTable
     */
    public $Deposits;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.deposits',
        'app.surveys',
        'app.domains',
        'app.users',
        'app.centers',
        'app.logs',
        'app.domains_users',
        'app.attachemnts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Deposits') ? [] : ['className' => DepositsTable::class];
        $this->Deposits = TableRegistry::get('Deposits', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Deposits);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
