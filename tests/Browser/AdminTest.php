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
     * Test the user delete functionality in the admin panel
     *
     * @return void
     */
    public function testUserDeleteFunctionality()
    {
        $userToBeDeleted = factory(\App\User::class)->create([
            'email' => 'normalusertest@localhost.com',
            'password' => bcrypt('testpass'),
            'permission' => 0 //normal user permission
        ]);
        $user = factory(\App\User::class)->create([
            'email' => 'admintest@localhost.com',
            'password' => bcrypt('testpass'),
            'permission' => 2 //admin permission
        ]);
        $this->browse(function (Browser $browser) use($userToBeDeleted) {
            $browser->visit('/login')
                ->type('email', 'admintest@localhost.com')
                ->type('password', 'testpass')
                ->press('Login')
                ->visit('/admin/delete/'.$userToBeDeleted->id)
                ->assertSee('User has been deleted!');
        });
        $user->delete();
    }

    /**
     * Test the user lock functionality in the admin panel
     *
     * @return void
     */
    public function testUserLockFunctionality()
    {
        $userToBeLocked = factory(\App\User::class)->create([
            'email' => 'normalusertest@localhost.com',
            'password' => bcrypt('testpass'),
            'permission' => 0 //normal user permission
        ]);
        $user = factory(\App\User::class)->create([
            'email' => 'admintest@localhost.com',
            'password' => bcrypt('testpass'),
            'permission' => 2 //admin permission
        ]);
        $this->browse(function (Browser $browser) use($userToBeLocked) {
            $browser->visit('/login')
                ->type('email', 'admintest@localhost.com')
                ->type('password', 'testpass')
                ->press('Login')
                ->visit('/admin/lock/'.$userToBeLocked->id)
                ->assertSee('User has been locked!');
        });
        $userToBeLocked->delete();
        $user->delete();
    }


    /**
     * Test the user unlock functionality in the admin panel
     *
     * @return void
     */
    public function testUserUnlockFunctionality()
    {
        $userToBeUnlocked = factory(\App\User::class)->create([
            'email' => 'normalusertest@localhost.com',
            'password' => bcrypt('testpass'),
            'permission' => 0 //normal user permission
        ]);
        $user = factory(\App\User::class)->create([
            'email' => 'admintest@localhost.com',
            'password' => bcrypt('testpass'),
            'permission' => 2 //admin permission
        ]);
        $this->browse(function (Browser $browser) use($userToBeUnlocked) {
            $browser->visit('/login')
                ->type('email', 'admintest@localhost.com')
                ->type('password', 'testpass')
                ->press('Login')
                ->visit('/admin/unlock/'.$userToBeUnlocked->id)
                ->assertSee('User has been unlocked!');
        });
        $userToBeUnlocked->delete();
        $user->delete();
    }


    /**
     * Test the user promote functionality in the super-admin panel
     *
     * @return void
     */
    public function testUserPromoteFunctionality()
    {
        $userToBePromoted = factory(\App\User::class)->create([
            'email' => 'normalusertest@localhost.com',
            'password' => bcrypt('testpass'),
            'permission' => 0 //normal user permission
        ]);
        $user = factory(\App\User::class)->create([
            'email' => 'admintest@localhost.com',
            'password' => bcrypt('testpass'),
            'permission' => 1 //super-admin permission
        ]);
        $this->browse(function (Browser $browser) use($userToBePromoted) {
            $browser->visit('/login')
                ->type('email', 'admintest@localhost.com')
                ->type('password', 'testpass')
                ->press('Login')
                ->visit('/admin/promote/'.$userToBePromoted->id)
                ->assertSee('User has been promoted!');
        });
        $userToBePromoted->delete();
        $user->delete();
    }


    /**
     * Test the user demote functionality in the super-admin panel
     *
     * @return void
     */
    public function testUserDemoteFunctionality()
    {
        $userToBeDemoted = factory(\App\User::class)->create([
            'email' => 'normalusertest@localhost.com',
            'password' => bcrypt('testpass'),
            'permission' => 0 //normal user permission
        ]);
        $user = factory(\App\User::class)->create([
            'email' => 'admintest@localhost.com',
            'password' => bcrypt('testpass'),
            'permission' => 1 //super-admin permission
        ]);
        $this->browse(function (Browser $browser) use($userToBeDemoted) {
            $browser->visit('/login')
                ->type('email', 'admintest@localhost.com')
                ->type('password', 'testpass')
                ->press('Login')
                ->visit('/admin/demote/'.$userToBeDemoted->id)
                ->assertSee('User has been demoted!');
        });
        $userToBeDemoted->delete();
        $user->delete();
    }


    /**
     * Test direct access of normal user to admin path
     * Normal users shouldn't be able to access the admin page
     * @return void
     */
    public function testNormalUserAdminPageAccess()
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

    /**
     * Test direct access of normal user to admin/delete path
     * Normal users shouldn't be able to access the admin/delete page
     * @return void
     */
    public function testNormalUserDeletePageAccess()
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
                ->visit('/admin/delete/1')
                ->assertSee('Sorry, you\'re not the Administrator');
        });
        $user->delete();
    }


    /**
     * Test direct access of normal user to admin/unlock path
     * Normal users shouldn't be able to access the admin/unlock page
     * @return void
     */
    public function testNormalUserUnlockPageAccess()
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
                ->visit('/admin/unlock/1')
                ->assertSee('Sorry, you\'re not the Administrator');
        });
        $user->delete();
    }


    /**
     * Test direct access of normal user to admin/lock path
     * Normal users shouldn't be able to access the admin/lock page
     * @return void
     */
    public function testNormalUserLockPageAccess()
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
                ->visit('/admin/lock/1')
                ->assertSee('Sorry, you\'re not the Administrator');
        });
        $user->delete();
    }


    /**
     * Test direct access of normal user to admin/promote path
     * Normal users shouldn't be able to access the admin/promote page
     * @return void
     */
    public function testNormalUserPromotePageAccess()
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
                ->visit('/admin/promote/1')
                ->assertSee('Sorry, you\'re not the Super Administrator');
        });
        $user->delete();
    }


    /**
     * Test direct access of normal user to admin/demote path
     * Normal users shouldn't be able to access the admin/demote page
     * @return void
     */
    public function testNormalUserDemotePageAccess()
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
                ->visit('/admin/demote/1')
                ->assertSee('Sorry, you\'re not the Super Administrator');
        });
        $user->delete();
    }


    /**
     * Test direct access of admin user to admin/promote path
     * Admin shouldn't be able to access the admin/promote page (Only super admin can access this route)
     * @return void
     */
    public function testAdminPromotePageAccess()
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
                ->visit('/admin/promote/1')
                ->assertSee('Sorry, you\'re not the Super Administrator');
        });
        $user->delete();
    }


    /**
     * Test direct access of admin to admin/demote path
     * Admin shouldn't be able to access the admin/demote page (Only super admin can access this route)
     * @return void
     */
    public function testAdminDemotePageAccess()
    {
        $user = factory(\App\User::class)->create([
            'email' => 'admintest@localhost.com',
            'password' => bcrypt('testpass'),
            'permission' => 0 //user permission
        ]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'admintest@localhost.com')
                ->type('password', 'testpass')
                ->press('Login')
                ->visit('/admin/demote/1')
                ->assertSee('Sorry, you\'re not the Super Administrator');
        });
        $user->delete();
    }
}
