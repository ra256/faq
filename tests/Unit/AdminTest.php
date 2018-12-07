<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    /** @test */
    public function lockUser()
    {
        $user = $user = factory(\App\User::class)->make();
        $user->locked = 1;
        $this->assertTrue($user->save());
    }
    /** @test */
    public function unlockUser()
    {
        $user = $user = factory(\App\User::class)->make();
        $user->locked = 0;
        $this->assertTrue($user->save());
    }
}
