<?php

namespace Database\Seeders;

use App\Models\Converts;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConvertsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Converts::create(['id_pair'=>'1','count_conversion'=>'0']);
        Converts::create(['id_pair'=>'2','count_conversion'=>'0']);
    }

}
