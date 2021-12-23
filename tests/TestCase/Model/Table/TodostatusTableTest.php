<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TodostatusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TodostatusTable Test Case
 */
class TodostatusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TodostatusTable
     */
    public $Todostatus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Todostatus',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Todostatus') ? [] : ['className' => TodostatusTable::class];
        $this->Todostatus = TableRegistry::getTableLocator()->get('Todostatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Todostatus);

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
}
