<?php
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'admin@raheelminiproject3.herokuapp.com',
            'password' => bcrypt('admin'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'locked' => 0,
            'permission' => 1
        ]);
//        $this->call(UsersTableSeeder::class);
//        $this->call(QuestionsTableSeeder::class);
//        $this->call(AnswersTableSeeder::class);
    }
}