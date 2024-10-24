<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(base_path('resources/data/sizes.json'));
        $sizes = json_decode($json, true);

        if (is_null($sizes) || !is_array($sizes)) {
            $this->command->error("Error al decodificar el JSON.");
            return;
        }

        foreach ($sizes as $size) {
            DB::table('sizes')->insert([
                'size_id' => $size['size_id'],
                'name' => $size['name'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        }
}
