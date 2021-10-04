<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Catagories;

class CatagoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Catagories::factory(10)->create();   
    }
}
