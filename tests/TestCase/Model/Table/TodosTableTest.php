<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TodosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TodosTable Test Case
 */
class TodosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TodosTable
     */
    public $Todos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Todos',
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
        $config = TableRegistry::getTableLocator()->exists('Todos') ? [] : ['className' => TodosTable::class];
        $this->Todos = TableRegistry::getTableLocator()->get('Todos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Todos);

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
