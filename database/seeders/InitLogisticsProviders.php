<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class InitLogisticsProviders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $providers = [];
        for ($i = 1; $i <= 3; $i++) {
            $providers[] = [
                'name' => 'Logistics providers' . $i,
                'cost' => rand(100, 999),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        DB::table('logistics_providers')->insert($providers);
    }
}
