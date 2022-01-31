<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(!User::find(1))
         User::create([
            'id' => 1,
            'name' => 'Joanna',
            'email' => 'joanna@interog.pl',
            'password' => Hash::make('1qazxsW@'),
        ]);
    }
}
