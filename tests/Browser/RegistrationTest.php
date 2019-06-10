<?php

namespace Tests\Browser;

use App\Models\User\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegistrationTest extends DuskTestCase
{
    public function test_guest_can_register()
    {
        $test_mail = uniqid().'@dusttestuser.com';
        $this->browse(function ($browser) use ($test_mail) {
            $browser->visit('/register')
                ->assertSourceHas('<form method="POST" action="http://localhost/register">')
                ->type('email', $test_mail)
                ->type('name', 'Jan Kowalski')
                ->type('password', 'testpassword123')
                ->type('password_confirmation', 'testpassword123')
                ->press('Register')
                ->assertPathIs('/');
        });
        $test_user = User::where('email', '=', $test_mail)->first();
        if($test_user){
            $test_user->forceDelete();
        }
    }
}
