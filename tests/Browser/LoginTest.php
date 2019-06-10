<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_user_can_view_a_login_form()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSourceHas('<form method="POST" action="http://localhost/login">');
        });
    }
}
