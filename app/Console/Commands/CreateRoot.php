<?php

namespace App\Console\Commands;

use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;

class CreateRoot extends Command
{
    protected $signature = 'create:user {password}';
    protected $description = 'Create a user with email "root" and the provided password';

    public function handle()
    {
        // Verifica si ya existe un usuario con el email "root"
        $existingUser = Client::where('email', 'root@root')->first();

        if ($existingUser) {
            $this->info('User with email "root" already exists.');
            return;
        }

        // Obtiene la contraseña proporcionada como argumento
        $password = $this->argument('password');

        // Crea el nuevo usuario
        $user = Client::create([
            'name' => 'Root',
            'lastname' => 'User',
            'email' => 'root@root',
            'password' => Hash::make($password),
            'role' => 'admin',
            'balance' => 0,
            'isActive' => true,
            'account' => '00000000000000000000'
        ]);

        $this->info('User with email "root" created successfully.');
    }
}
