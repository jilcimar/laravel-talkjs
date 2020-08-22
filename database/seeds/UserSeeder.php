<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        
        \App\Models\User::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('123'),
        ]);
    }
}
