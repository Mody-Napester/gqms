<?php

use Illuminate\Database\Seeder;

class QueueStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // queue types (1 -> Desk, 2 -> Doctor)
        $types = [
            // Desk
            ['queue_type'=>'1', 'class'=>'label-purple', 'en'=>'Waiting', 'ar'=>'انتظار'],
            ['queue_type'=>'1', 'class'=>'label-primary', 'en'=>'Called', 'ar'=>'على الشباك'],
            ['queue_type'=>'1', 'class'=>'label-danger', 'en'=>'Skipped', 'ar'=>'غير موجود'],
            ['queue_type'=>'1', 'class'=>'label-success', 'en'=>'Done', 'ar'=>'تم الخدمة'],
            ['queue_type'=>'1', 'class'=>'label-warning', 'en'=>'Call from skip', 'ar'=>'رجوع'],

            // Doctor
            ['queue_type'=>'2', 'class'=>'label-purple', 'en'=>'Waiting', 'ar'=>'انتظار'],
            ['queue_type'=>'2', 'class'=>'label-primary', 'en'=>'Called', 'ar'=>'على الشباك'],
            ['queue_type'=>'2', 'class'=>'label-pink', 'en'=>'Patient In', 'ar'=>'فى العيادة'],
            ['queue_type'=>'2', 'class'=>'label-danger', 'en'=>'Skipped', 'ar'=>'غير موجود'],
            ['queue_type'=>'2', 'class'=>'label-success', 'en'=>'Patient Out', 'ar'=>'تم الكشف'],
            ['queue_type'=>'2', 'class'=>'label-warning', 'en'=>'Call from skip', 'ar'=>'رجوع'],
        ];

        foreach ($types as $type){
            \Illuminate\Support\Facades\DB::table('queue_statuses')->insert([
                'uuid' => (string) \Webpatser\Uuid\Uuid::generate(config('vars.uuid_ver')),
                'queue_type' => $type['queue_type'],
                'class' => $type['class'],
                'name_ar' => $type['ar'],
                'name_en' => $type['en']
            ]);
        }
    }
}
