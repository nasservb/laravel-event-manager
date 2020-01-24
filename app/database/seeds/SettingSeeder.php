<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * add app setting
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'title'=>'درایور پیش فرض برای یادآوری شرکت در رویداد',
            'key'=>'default_reminder_driver',
            'type'=>'text',
            'value'=>'email' //can set to sms, push or other available driver
        ]);

        DB::table('settings')->insert([
            'title'=>'درایور پیش فرض برای اطلاع رسانی دعوت شدن به رویداد',
            'key'=>'default_invite_driver',
            'type'=>'text',
            'value'=>'email' //can set to sms, push or other available driver
        ]);

        DB::table('settings')->insert([
            'title'=>'درایور پیش فرض برای ارسال پیامک',
            'key'=>'sms_default_driver',
            'type'=>'text',
            'value'=>'kavenegar' //can set to firebase, payamak-panel or other available driver
        ]);


        DB::table('settings')->insert([
            'title'=>'عنوان پیش فرض برای اطلاع رسانی دعوت شدن به رویداد',
            'key'=>'default_invite_title',
            'type'=>'text',
            'value'=>'دعوت نامه جدید در Dataak' //can set to sms, push or other available driver
        ]);


        DB::table('settings')->insert([
            'title'=>'آدرس اپلیکیشن آی او اس در اپ استور',
            'key'=>'ios_app_store_url',
            'type'=>'text',
            'value'=>'http://url' //can set to sms, push or other available driver
        ]);


        DB::table('settings')->insert([
            'title'=>'آدرس اپلیکیشن اندروید در گوگل پلی',
            'key'=>'android_app_googleplay_url',
            'type'=>'text',
            'value'=>'http://url' //can set to sms, push or other available driver
        ]);


    }
}
