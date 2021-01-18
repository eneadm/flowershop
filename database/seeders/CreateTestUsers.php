<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateTestUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret'),
        ]);

        $customer = User::create([
            'name' => 'Customer',
            'email' => 'customer@example.com',
            'password' => bcrypt('secret'),
        ]);

        $team = Team::create([
            'user_id' => $admin->id,
            'name' => 'Flower Shop',
            'personal_team' => false,
        ]);

        $admin->switchTeam($team);

        $team->users()->save($admin, ['role' => 'admin']);

        $team->users()->save($customer, ['role' => 'customer']);


    }
}
