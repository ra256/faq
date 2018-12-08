<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    /** @test */
    public function lockUser()
    {
        $user = factory(\App\User::class)->make();
        $user->locked = 1;
        $this->assertTrue($user->save());
    }
    /** @test */
    public function unlockUser()
    {
        $user = factory(\App\User::class)->make();
        $user->locked = 0;
        $this->assertTrue($user->save());
    }
}
