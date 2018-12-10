<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserAccessTest extends DuskTestCase
{
    /**
     * Test user with normal access.
     *
     * @return void
     */
    public function testNormalUser()
    {
        $user = factory(\App\User::class)->create([
            'email' => 'normalaccount@localhost.com',
            'password' => bcrypt('testpass'),
            'locked' => 0
        ]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'normalaccount@localhost.com')
                    ->type('password', 'testpass')
                    ->press('Login')
                    ->assertSee('Questions');
        });
        $user->delete();
    }

    /**
     * Test locked users.
     *
     * @return void
     */
    public function testLockedUser()
    {
        $user = factory(\App\User::class)->create([
            'email' => 'lockedaccount@localhost.com',
            'password' => bcrypt('testpass'),
            'locked' => 1
        ]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'lockedaccount@localhost.com')
                ->type('password', 'testpass')
                ->press('Login')
                ->assertSee('Error! Your account has been locked.');
        });
        $user->delete();
    }
}
