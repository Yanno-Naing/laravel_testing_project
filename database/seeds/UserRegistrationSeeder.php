<?php

use Illuminate\Database\Seeder;

class UserRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_registration')->insert([
            'user_name' => Str::random(10),
            'father_name' => Str::random(10),
            'nrc' => '7/KaTaKha(N)16837',
            'email' => Str::random(10).'@gmail.com',
            'phone_no' => '09123456789',
            'address' => Str::random(20),
            'gender' => 1,
            'birthday' => date('Y-m-d H:i:s',mktime(0,0,0,5,17,2000)),
        ]);
    }
}
