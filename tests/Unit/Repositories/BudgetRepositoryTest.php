<?php

namespace Tests\Unit\Repositories;

use App\Models\Budget;
use App\Models\Space;
use App\Models\Spending;
use App\Models\Tag;
use App\Repositories\BudgetRepository;
use Exception;
use Tests\TestCase;

class BudgetRepositoryTest extends TestCase
{
    private $budgetRepository;
    private $spaceId;

    public function setUp(): void
    {
        parent::setUp();

        $this->budgetRepository = new BudgetRepository();
        $this->spaceId = Space::factory()->create()->id;
    }

    /**
     * getValidationRules()
     */

    public function testGetValidationRulesMethod(): void
    {
        $this->assertIsArray($this->budgetRepository->getValidationRules());
    }

    /**
     * getSupportedPeriods()
     */

    public function testGetSupportedPeriodsMethod(): void
    {
        $supportedPeriods = $this->budgetRepository->getSupportedPeriods();

        $this->assertIsArray($supportedPeriods);
        $this->assertContains('monthly', $supportedPeriods);
    }

    /**
     * doesExist()
     */

    public function testDoesExistMethodUsingNonExistingBudget(): void
    {
        // Assert that non-existing budget returns false
        $this->assertEquals(false, $this->budgetRepository->doesExist(999, 999));
    }

    public function testDoesExistMethodUsingExistingBudget(): void
    {
        Budget::factory()->create(['space_id' => 1, 'tag_id' => 1]);

        // Assert that existing budget returns true
        $this->assertEquals(true, $this->budgetRepository->doesExist(1, 1));
    }

    public function testDoesExistMethodUsingExpiredBudget(): void
    {
        Budget::factory()->create([
            'space_id' => 1,
            'tag_id' => 2,
            'starts_on' => date('Y-m-d', strtotime('-2 months')),
            'ends_on' => date('Y-m-d', strtotime('-1 month'))
        ]);

        // Assert that expired budget returns false
        $this->assertEquals(false, $this->budgetRepository->doesExist(1, 2));
    }

    /**
     * getActive()
     */

    public function testGetActiveMethodUsingFreshSpace(): void
    {
        $space = Space::factory()->create(['id' => 200]);

        $this->withSession(['space_id' => $space->id]);
        $this->assertEmpty($this->budgetRepository->getActive());
    }

    public function testGetActiveMethodUsingInactiveBudget(): void
    {
        $tag = Tag::factory()->create(['space_id' => 200]);

        Budget::factory()->create([
            'space_id' => 200,
            'tag_id' => $tag->id,
            'starts_on' => date('Y-m-d', strtotime('first day of last month')),
            'ends_on' => date('Y-m-d', strtotime('last day of last month'))
        ]);

        $this->withSession(['space_id' => 200]);
        $this->assertEmpty($this->budgetRepository->getActive());
    }

    public function testGetActiveMethodUsingActiveBudget(): void
    {
        $tag = Tag::factory()->create(['space_id' => 200]);

        Budget::factory()->create([
            'space_id' => 200,
            'tag_id' => $tag->id,
            'starts_on' => date('Y-m-d', strtotime('first day of this month'))
        ]);

        $this->withSession(['space_id' => 200]);
        $this->assertCount(1, $this->budgetRepository->getActive());
    }

    /**
     * getById()
     */

    public function testGetByIdMethodUsingNonExistingBudget(): void
    {
        // Assert that non-existing budget doesn't actually exist
        $this->assertNull($this->budgetRepository->getById(999));
    }

    public function testGetByIdMethodUsingExistingBudget(): void
    {
        $budget = Budget::factory()->create();

        // Assert that existing budget actually exists
        $this->assertEquals($budget->id, $this->budgetRepository->getById($budget->id)->id);
    }

    /**
     * getSpentById()
     */

    public function testGetSpentByIdUsingNonExistingBudget(): void
    {
        // Assert that non-existing budget throws exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Could not find budget (where ID is 999)');

        $this->budgetRepository->getSpentById(999);
    }

    public function testGetSpentByIdUsingNonExistingPeriod(): void
    {
        $budget = Budget::factory()->create([
            'space_id' => 1,
            'tag_id' => 3,
            'period' => 'hourly'
        ]);

        // Assert that non-existing period throws exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('No clue what to do with period "hourly"');

        $this->budgetRepository->getSpentById($budget->id);
    }

    public function testGetSpentByIdUsingFreshBudget(): void
    {
        $this->withSession(['space_id' => 1]);

        $budget = Budget::factory()->create([
            'space_id' => 1,
            'tag_id' => 3
        ]);

        // Assert that newly created budget returns 0
        $this->assertEquals(0, $this->budgetRepository->getSpentById($budget->id));
    }

    public function testGetSpentByIdUsingYearlyBudget(): void
    {
        $this->withSession(['space_id' => $this->spaceId]);

        $tag = Tag::factory()->create(['space_id' => $this->spaceId]);

        $budget = Budget::factory()->create([
            'space_id' => $this->spaceId,
            'tag_id' => $tag->id,
            'period' => 'yearly'
        ]);

        // Assertion without spendings
        $this->assertEquals(0, $this->budgetRepository->getSpentById($budget->id));

        Spending::factory()->create([
            'space_id' => $this->spaceId,
            'tag_id' => $tag->id,
            'happened_on' => date('Y-m-d', strtotime('last year')),
            'amount' => 123
        ]);

        // Assertion with spendings, but outside of period
        $this->assertEquals(0, $this->budgetRepository->getSpentById($budget->id));

        Spending::factory()->create([
            'space_id' => $this->spaceId,
            'tag_id' => $tag->id,
            'happened_on' => date('Y-m-d'),
            'amount' => 123
        ]);

        // Assertion with spendings within period
        $this->assertEquals(123, $this->budgetRepository->getSpentById($budget->id));
    }

    public function testGetSpentByIdUsingMonthlyBudget(): void
    {
        $this->withSession(['space_id' => $this->spaceId]);

        $tag = Tag::factory()->create(['space_id' => $this->spaceId]);

        $budget = Budget::factory()->create([
            'space_id' => $this->spaceId,
            'tag_id' => $tag->id,
            'period' => 'monthly'
        ]);

        // Assertion without spendings
        $this->assertEquals(0, $this->budgetRepository->getSpentById($budget->id));

        Spending::factory()->create([
            'space_id' => $this->spaceId,
            'tag_id' => $tag->id,
            'happened_on' => date('Y-m-d', strtotime('last month')),
            'amount' => 123
        ]);

        // Assertion with spendings, but outside of period
        $this->assertEquals(0, $this->budgetRepository->getSpentById($budget->id));

        Spending::factory()->create([
            'space_id' => $this->spaceId,
            'tag_id' => $tag->id,
            'happened_on' => date('Y-m-d'),
            'amount' => 123
        ]);

        // Assertion with spendings within period
        $this->assertEquals(123, $this->budgetRepository->getSpentById($budget->id));
    }

    public function testGetSpentByIdUsingWeeklyBudget(): void
    {
        $this->withSession(['space_id' => $this->spaceId]);

        $tag = Tag::factory()->create(['space_id' => $this->spaceId]);

        $budget = Budget::factory()->create([
            'space_id' => $this->spaceId,
            'tag_id' => $tag->id,
            'period' => 'weekly'
        ]);

        // Assertion without spendings
        $this->assertEquals(0, $this->budgetRepository->getSpentById($budget->id));

        Spending::factory()->create([
            'space_id' => $this->spaceId,
            'tag_id' => $tag->id,
            'happened_on' => date('Y-m-d', strtotime('2 weeks ago')),
            'amount' => 123
        ]);

        // Assertion with spendings, but outside of period
        $this->assertEquals(0, $this->budgetRepository->getSpentById($budget->id));

        Spending::factory()->create([
            'space_id' => $this->spaceId,
            'tag_id' => $tag->id,
            'happened_on' => date('Y-m-d'),
            'amount' => 123
        ]);

        // Assertion with spendings within period
        $this->assertEquals(123, $this->budgetRepository->getSpentById($budget->id));
    }

    public function testGetSpentByIdUsingDailyBudget(): void
    {
        $this->withSession(['space_id' => $this->spaceId]);

        $tag = Tag::factory()->create(['space_id' => $this->spaceId]);

        $budget = Budget::factory()->create([
            'space_id' => $this->spaceId,
            'tag_id' => $tag->id,
            'period' => 'daily'
        ]);

        // Assertion without spendings
        $this->assertEquals(0, $this->budgetRepository->getSpentById($budget->id));

        Spending::factory()->create([
            'space_id' => $this->spaceId,
            'tag_id' => $tag->id,
            'happened_on' => date('Y-m-d', strtotime('yesterday')),
            'amount' => 123
        ]);

        // Assertion with spendings, but outside of period
        $this->assertEquals(0, $this->budgetRepository->getSpentById($budget->id));

        Spending::factory()->create([
            'space_id' => $this->spaceId,
            'tag_id' => $tag->id,
            'happened_on' => date('Y-m-d'),
            'amount' => 123
        ]);

        // Assertion with spendings within period
        $this->assertEquals(123, $this->budgetRepository->getSpentById($budget->id));
    }

    /**
     * create()
     */

    public function testCreateMethodUsingAlreadyExistingBudget(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Budget (with space ID being 1 and tag ID being 3) already exists');

        $this->budgetRepository->create(1, 3, 'monthly', 100);
    }

    public function testCreateMethodUsingNonExistingPeriod(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unknown period "hourly"');

        $this->budgetRepository->create(1, 10, 'hourly', 100);
    }

    public function testCreateMethodUsingValidArguments(): void
    {
        $budget = $this->budgetRepository->create(1, 10, 'monthly', 100);

        $this->assertNotNull($budget->id);
    }
}
