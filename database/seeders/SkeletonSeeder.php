<?php

use Illuminate\Database\Seeder;

class SkeletonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skeletons')->truncate();

        DB::table('skeletons')->insert([
            'name' => 'Test',
        ]);
    }
}
