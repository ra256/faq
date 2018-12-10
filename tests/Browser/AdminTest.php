<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends DuskTestCase
{
    /**
     * Test super-admin login
     *
     * @return void
     */
    public function testSuperAdminLogin()
    {
        $user = factory(\App\User::class)->create([
            'email' => 'superadmintest@localhost.com',
            'password' => bcrypt('testpass'),
            'permission' => 1 //Superadmin permission
        ]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'superadmintest@localhost.com')
                ->type('password', 'testpass')
                ->press('Login')
                ->visit('/admin')
                ->assertSee('Welcome Super Admin');
        });
        $user->delete();
    }

    /**
     * Test admin login
     *
     * @return void
     */
    public function testAdminLogin()
    {
        $user = factory(\App\User::class)->create([
            'email' => 'admintest@localhost.com',
            'password' => bcrypt('testpass'),
            'permission' => 2 //admin permission
        ]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'admintest@localhost.com')
                ->type('password', 'testpass')
                ->press('Login')
                ->visit('/admin')
                ->assertSee('Welcome Admin');
        });
        $user->delete();
    }

    /**
     * Test direct access of normal user to admin path
     * Normal users shouldn't be able to access the admin page
     * @return void
     */
    public function NormalUserAdminAccess()
    {
        $user = factory(\App\User::class)->create([
            'email' => 'normalusertest@localhost.com',
            'password' => bcrypt('testpass'),
            'permission' => 0 //user permission
        ]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'normalusertest@localhost.com')
                ->type('password', 'testpass')
                ->press('Login')
                ->visit('/admin')
                ->assertSee('Sorry, you\'re not the Administrator');
        });
        $user->delete();
    }
}
