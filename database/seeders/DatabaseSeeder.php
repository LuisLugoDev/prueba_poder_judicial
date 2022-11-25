<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
   
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'administrador@mail.com';
        $user->password = Hash::make('admin');
        $user->role = 'admin';

        $user->save();

        User::create([
            'name' => 'Cliente',
            'email' => 'cliente@mail.com',
            'password' => Hash::make('cliente')
        ]);

        User::create([
            'name' => 'Cliente2',
            'email' => 'cliente2@mail.com',
            'password' => Hash::make('cliente')
        ]);
    }
}
