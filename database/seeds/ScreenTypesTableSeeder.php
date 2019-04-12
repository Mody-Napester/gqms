<?php

use Illuminate\Database\Seeder;

class ScreenTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [['en'=>'Kiosk', 'ar'=>'كشك'],['en'=>'Reception', 'ar'=>'ريسبشن']];

        foreach ($types as $type){
            \Illuminate\Support\Facades\DB::table('screen_types')->insert([
                'name_ar' => $type['ar'],
                'name_en' => $type['en']
            ]);
        }
    }
}
