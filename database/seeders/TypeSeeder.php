<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'title' => 'urgent',
        ]);
        DB::table('types')->insert([
            'title' => 'normal',
        ]);
        DB::table('types')->insert([
            'title' => 'on date',
        ]);
    } 
}
