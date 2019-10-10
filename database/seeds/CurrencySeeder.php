<?php

use Illuminate\Database\Seeder;
use App\Currency as model;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(storage_path('data/countries.json'));
        $outputArray = collect(json_decode($json));
        foreach ($outputArray as $data) {
            foreach ($data->currencies as $currency) {
                if ($currency->symbol != null && $currency->name != null) {
                    if (strlen($currency->name) > 3) {
                        model::updateorcreate([
                            'name' => $currency->name
                        ], [
                            'symbol' => $this->html_entity_encode_all($currency->symbol)
                        ]);
                    }
                }
            }
        }
    }

    private function html_entity_encode_all($s)
    {
        $out = '';
        for ($i = 0; isset($s[$i]); $i++) {
            // read UTF-8 bytes and decode to a Unicode codepoint value:
            $x = ord($s[$i]);
            if ($x < 0x80) {
                // single byte codepoints
                $codepoint = $x;
            } else {
                // multibyte codepoints
                if ($x >= 0xC2 && $x <= 0xDF) {
                    $codepoint = $x & 0x1F;
                    $length = 2;
                } else if ($x >= 0xE0 && $x <= 0xEF) {
                    $codepoint = $x & 0x0F;
                    $length = 3;
                } else if ($x >= 0xF0 && $x <= 0xF4) {
                    $codepoint = $x & 0x07;
                    $length = 4;
                } else {
                    // invalid byte
                    $codepoint = 0xFFFD;
                    $length = 1;
                }
                // read continuation bytes of multibyte sequences:
                for ($j = 1; $j < $length; $j++, $i++) {
                    if (!isset($s[$i + 1])) {
                        // invalid: string truncated in middle of multibyte sequence
                        $codepoint = 0xFFFD;
                        break;
                    }
                    $x = ord($s[$i + 1]);
                    if (($x & 0xC0) != 0x80) {
                        // invalid: not a continuation byte
                        $codepoint = 0xFFFD;
                        break;
                    }
                    $codepoint = ($codepoint << 6) | ($x & 0x3F);
                }
                if (($codepoint > 0x10FFFF) || ($length == 2 && $codepoint < 0x80) || ($length == 3 && $codepoint < 0x800) || ($length == 4 && $codepoint < 0x10000)
                ) {
                    // invalid: overlong encoding or out of range
                    $codepoint = 0xFFFD;
                }
            }

            // have codepoint, now output:
            if (($codepoint >= 48 && $codepoint <= 57) || ($codepoint >= 65 && $codepoint <= 90) || ($codepoint >= 97 && $codepoint <= 122) || ($codepoint == 32)
            ) {
                // leave plain 0-9, A-Z, a-z, and space unencoded
                $out .= $s[$i];
            } else {
                // all others as numeric entities
                $out .= '&#' . $codepoint . ';';
            }
        }
        return $out;
    }
}
