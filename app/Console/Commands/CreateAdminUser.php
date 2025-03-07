<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;


class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {name} {email} {phone_number} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get arguments from command line
        $name = $this->argument('name');
        $email = $this->argument('email');
        $phone_number = $this->argument('phone_number');

        $password = $this->argument('password');

        // Create a new admin user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number,
            'password' => bcrypt($password),
            'role' => 'admin', // Assign admin role
        ]);
         // Inform the user the admin has been created
         $this->info("Admin user '{$name}' has been created successfully.");
    }
}
