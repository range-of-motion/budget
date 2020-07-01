<?php

use App\Models\Currency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsoColumnToCurrenciesTable extends Migration
{
    public function up(): void
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->string('iso')->after('symbol');
        });

        foreach (Currency::all() as $currency) {
            $iso = $currency->symbol;

            if (strlen($currency->symbol) !== 3) {
                switch ($currency->symbol) {
                    case '&euro;';
                        $iso = 'EUR';
                        break;

                    case '&dollar;';
                        $iso = 'USD';
                        break;

                    case '&pound;';
                        $iso = 'GBP';
                        break;
                }
            }

            $currency->fill(['iso' => $iso])->save();
        }
    }

    public function down(): void
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->dropColumn('iso');
        });
    }
}
