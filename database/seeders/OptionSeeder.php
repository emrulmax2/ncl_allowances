<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Option::factory()->times(1)->create();
        Option::create([
            "categroy" => "SITE_SETTINGS",
            "fieldname" => "powerd_by",
            "fielvalue" => "kweelabs.com",
            'created_by' => 1,
            'created_at' => now()
        ]);
    }
}
