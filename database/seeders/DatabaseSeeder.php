<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Paul Jankowski',
            'email' => 'pjankowski25@gmail.com',
            'username' => 'pjankowski25',
            'display_name' => 'PJankowski25',
        ]);

        $subs = Sub::factory()->count(3)->hasPosts(7, ['owner_id' => $user->id])->create();

        foreach ($subs as $sub) {
            $user->subs()->attach($sub, ['role' => 'owner']);
        }
    }
}
