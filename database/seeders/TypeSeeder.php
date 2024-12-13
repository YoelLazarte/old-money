<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 

class TypeSeeder extends Seeder
{
    public function run(): void {

        $json = File::get(base_path('resources/data/types.json'));
        $types = json_decode($json, true);

        if (is_null($types) || !is_array($types)) {
            $this->command->error("Error al decodificar el JSON.");
            return;
        }

        foreach ($types as $type) {
            DB::table('types')->insert([
                'type_id' => $type['type_id'],
                'name' => $type['name'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
