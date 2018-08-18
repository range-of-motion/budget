<?php

use Illuminate\Database\Seeder;

use App\Spending;

class SpendingsTableSeeder extends Seeder {
    private function generateDate($year, $month) {
        $date = rand(1, cal_days_in_month(CAL_GREGORIAN, $month, $year));

        if ($year == date('Y') && $month == date('n') && $date > date('j')) {
            $date = rand(1, date('j'));
        }

        return $date;
    }

    private function insertSpending($tag_id, $happened_on, $description, $amount) {
        $formattedAmount = $amount;

        if (gettype($amount) == 'array') {
            $formattedAmount = rand($amount[0], $amount[1]);
        }

        $currentTimestamp = date('Y-m-d H:i:s');

        Spending::insert([
            'user_id' => 1,
            'tag_id' => $tag_id,
            'happened_on' => $happened_on,
            'description' => $description,
            'amount' => $formattedAmount,
            'created_at' => $currentTimestamp,
            'updated_at' => $currentTimestamp
        ]);
    }

    public function run() {
        $randomSets = [
            [
                'tag_id' => 1,
                'description' => 'Grocery Store Trip',
                'amount' => [75, 950]
            ], [
                'tag_id' => 3,
                'description' => 'Public Transport',
                'amount' => [500, 3500]
            ], [
                'tag_id' => 3,
                'description' => 'Fuel',
                'amount' => [2000, 5000]
            ]
        ];

        $monthlySets = [
            [
                'tag_id' => 2,
                'description' => 'Spotify',
                'amount' => 250
            ], [
                'tag_id' => 2,
                'description' => 'Gym Membership',
                'amount' => 2500
            ], [
                'tag_id' => 2,
                'description' => 'Health Insurance',
                'amount' => 10950
            ]
        ];

        for ($i = 0; $i < 6; $i ++) {
            $year = date('Y');
            $month = date('n') - $i;

            if ($month <= 0) {
                $year --;
                $month = 12 + $month;
            }

            foreach ($monthlySets as $set) {
                $date = $this->generateDate($year, $month);

                $this->insertSpending(
                    $set['tag_id'],
                    $year . '-' . $month . '-' . $date,
                    $set['description'],
                    $set['amount']
                );
            }

            for ($o = 0; $o < 3; $o ++) {
                $set = $randomSets[array_rand($randomSets)];

                $date = $this->generateDate($year, $month);

                $this->insertSpending(
                    $set['tag_id'],
                    $year . '-' . $month . '-' . $date,
                    $set['description'],
                    $set['amount']
                );
            }

            // Done
        }
    }
}
