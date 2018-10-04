<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase {
    public function testBasicExample() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'johnd@gmail.com')
                ->type('password', 'doe123')
                ->press('Log in')
                ->assertPathIs('/login');
        });
    }
}
