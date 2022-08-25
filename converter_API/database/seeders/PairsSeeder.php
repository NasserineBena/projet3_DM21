<?php

namespace Database\Seeders;

use App\Models\Pairs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class PairsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pairs::create(['currency_init'=>'1','currency_dest'=>'2', 'rate'=>'0.9']);
        Pairs::create(['currency_init'=>'2','currency_dest'=>'1', 'rate'=>'1.1']);
    }
}
