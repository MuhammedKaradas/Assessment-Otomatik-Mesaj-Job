<?php

namespace Database\Seeders;

use App\Models\MessageContact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MessageContact::factory()->count(5)->create();
    }
}
