<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Support\Facades\DB;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends DuskTestCase
{
    /**
     * normal user test
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

        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->type('email', 'normalaccount@localhost.com')
                ->type('password', 'testpass')
                ->press('Login')
                ->see('Questions')
                ->assertPathIs('/home');
        });
    }
    
    /**
     * Blocked user test
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

        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->type('email', 'lockedaccount@localhost.com')
                ->type('password', 'testpass')
                ->press('Login')
                ->see('Error! Your account has been locked.')
                ->assertPathIs('/home');
        });
    }
}
