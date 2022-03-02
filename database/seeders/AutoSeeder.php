<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $autos=\App\Models\Auto::factory(100)->create();
        foreach($autos as $item){
            if(!$item->user_id){
                $item->reservado=random_int(1,2);
                $item->update();
            }
            else{
                $item->reservado=null;
                $item->update();
            }
        }
    }
}
