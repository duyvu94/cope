<?php

use Illuminate\Database\Seeder;

class ProblemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('problems')->insert([
            'name' => 'Example',
            'difficulty' => 5,
            'time_limit' => 1000,
            'memory_limit' => 256,
            'pdf_path' => 'pdf/sample.pdf',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
