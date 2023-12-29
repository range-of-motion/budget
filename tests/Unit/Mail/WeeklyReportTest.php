<?php

namespace Tests\Unit\Mail;

use App\Mail\WeeklyReport;
use App\Models\Space;
use Tests\TestCase;

class WeeklyReportTest extends TestCase
{
    public function testMailableUsingSpaceWithoutTransactions(): void
    {
        $space = Space::factory()
            ->create([
                'currency_id' => 2, // Should be USD
                'name' => 'Foo Bar',
            ]);

        $mailable = new WeeklyReport(
            space: $space,
            week: 5,
            totalSpent: 0,
            largestSpendingWithTag: [],
        );

        $mailable
            ->assertSeeInText('Here\'s your weekly report for Foo Bar')
            ->assertSeeInText('This week (#5) you\'ve')
            ->assertSeeInText('- Spent &dollar; 0.00')
            ->assertDontSeeInText('Most of which you\'ve spent on');
    }

    public function testMailableUsingSpaceWithTransactions(): void
    {
        $space = Space::factory()
            ->create([
                'currency_id' => 2, // Should be USD
                'name' => 'Foo Bar',
            ]);

        $mailable = new WeeklyReport(
            space: $space,
            week: 5,
            totalSpent: 10000,
            largestSpendingWithTag: [(object) ['amount' => 7000, 'tag_name' => 'Insurance']],
        );

        $mailable
            ->assertSeeInText('Here\'s your weekly report for Foo Bar')
            ->assertSeeInText('This week (#5) you\'ve')
            ->assertSeeInText('- Spent &dollar; 100.00')
            ->assertSeeInText('- Most of which you\'ve spent on Insurance (&dollar; 70.00)');
    }
}
