<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'name' => 'LivraStaff',
            'email' => 'livrastaff@gmail.com',
            'password' => Hash::make('Staff123'),
            'role' => 'staff',
        ]);
    }
}
