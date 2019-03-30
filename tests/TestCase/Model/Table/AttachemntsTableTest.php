<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttachemntsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttachemntsTable Test Case
 */
class AttachemntsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AttachemntsTable
     */
    public $Attachemnts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.attachemnts',
        'app.deposits',
        'app.surveys',
        'app.domains',
        'app.users',
        'app.centers',
        'app.logs',
        'app.domains_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Attachemnts') ? [] : ['className' => AttachemntsTable::class];
        $this->Attachemnts = TableRegistry::get('Attachemnts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Attachemnts);

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
