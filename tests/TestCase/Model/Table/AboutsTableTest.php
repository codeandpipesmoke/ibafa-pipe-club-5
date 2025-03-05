<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AboutsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AboutsTable Test Case
 */
class AboutsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AboutsTable
     */
    protected $Abouts;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Abouts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Abouts') ? [] : ['className' => AboutsTable::class];
        $this->Abouts = $this->getTableLocator()->get('Abouts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Abouts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AboutsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
