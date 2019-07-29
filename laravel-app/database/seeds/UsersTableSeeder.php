<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $k43 = DB::table('groups')->insertGetId([
            'text' => 'K43 IT',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $k49 = DB::table('groups')->insertGetId([
            'text' => 'K49 IT',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Duy Vu',
            'email' => 'admin@csp.com',
            'email_verified_at' => now(),
            'is_admin' => true,
            'group_id' => $k43,
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        for ($i = 1 ; $i < 20; $i++)
        DB::table('users')->insert([
            'name' => 'Test User' . $i,
            'email' => 'test' . $i . '@csp.com',
            'email_verified_at' => now(),
            'is_admin' => false,
            'group_id' => $k49,
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
