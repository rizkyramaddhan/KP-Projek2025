<?php

namespace Database\Seeders;

use App\Models\LogActivity;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory()->count(10)->create();
        foreach($users as $user){
            LogActivity::factory()->count(5)->create([
                'username' => $user->username
            ]);
        }
    }
}
