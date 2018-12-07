<?php
use Illuminate\Database\Seeder;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(App\User::class, 50)->create()->each(function ($user) {
//            $user->profile()->save(factory(App\Profile::class)->make());
//        });

        //Add Admin
        DB::table('users')->insert([
            'email' => 'admin@raheelminiproject3.herokuapp.com',
            'password' => bcrypt('admin'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'locked' => 0,
            'permission' => 1
        ]);
    }
}