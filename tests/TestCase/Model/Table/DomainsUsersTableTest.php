<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DomainsUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DomainsUsersTable Test Case
 */
class DomainsUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DomainsUsersTable
     */
    public $DomainsUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.domains_users',
        'app.users',
        'app.centers',
        'app.deposits',
        'app.surveys',
        'app.domains',
        'app.attachemnts',
        'app.logs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DomainsUsers') ? [] : ['className' => DomainsUsersTable::class];
        $this->DomainsUsers = TableRegistry::get('DomainsUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DomainsUsers);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
