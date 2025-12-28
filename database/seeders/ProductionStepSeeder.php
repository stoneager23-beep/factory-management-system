<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductionStep;

class ProductionStepSeeder extends Seeder
{
    public function run(): void
    {
        $steps = [
            ['name' => 'Fabric In',        'sequence' => 1],
            ['name' => 'Cutting',          'sequence' => 2],
            ['name' => 'Stitching',        'sequence' => 3],
            ['name' => 'Washing',          'sequence' => 4],
            ['name' => 'Packing',          'sequence' => 5],
            ['name' => 'Pressing',         'sequence' => 6],
            ['name' => 'Quality Check',    'sequence' => 7],
            ['name' => 'Final Packing',    'sequence' => 8],
            ['name' => 'Dispatch / Gatepass','sequence' => 9],
        ];

        foreach ($steps as $step) {
            ProductionStep::updateOrCreate(
                ['name' => $step['name']],
                [
                    'sequence' => $step['sequence'],
                    'is_active' => true,
                ]
            );
        }
    }
}
