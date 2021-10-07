<?php

use App\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trn_settings')->truncate();
        // Create settings
        $settings = [
            [
                'key' => 'financial_start',
                'value' => '',
            ],
            [
                'key' => 'financial_end',
                'value' => '',
            ],
            [
                'key' => 'gym_email',
                'value' => 'jambasangsanggym@gmail.gm',
            ],
            [
                'key' => 'gym_logo',
                'value' => '',
            ],
            [
                'key' => 'gym_name',
                'value' => 'Company Name',
            ],
            [
                'key' => 'gym_address_1',
                'value' => '',
            ],
            [
                'key' => 'gym_address_2',
                'value' => '',
            ],
            [
                'key' => 'invoice_prefix',
                'value' => 'IP',
            ],
            [
                'key' => 'invoice_last_number',
                'value' => '0',
            ],
            [
                'key' => 'invoice_name_type',
                'value' => 'gym_name',
            ],
            [
                'key' => 'invoice_number_mode',
                'value' => '1',
            ],
            [
                'key' => 'member_prefix',
                'value' => 'MP',
            ],
            [
                'key' => 'member_last_number',
                'value' => '0',
            ],
            [
                'key' => 'member_number_mode',
                'value' => '1',
            ],
            [
                'key' => 'last_membership_check',
                'value' => '',
            ],
            [
                'key' => 'admission_fee',
                'value' => '0',
            ],
            [
                'key' => 'taxes',
                'value' => '10',
            ],
            [
                'key' => 'sms_api_key',
                'value' => '',
            ],
            [
                'key' => 'sms_sender_id',
                'value' => '',
            ],
            [
                'key' => 'sms',
                'value' => '0',
            ],
            [
                'key' => 'primary_contact',
                'value' => '081290348080',
            ],
            [
                'key' => 'discounts',
                'value' => '5,10,15,20,25',
            ],
            [
                'key' => 'sms_balance',
                'value' => '0',
            ],
            [
                'key' => 'sms_request',
                'value' => '0',
            ],
            [
                'key' => 'sender_id_list',
                'value' => '',
            ],
            [
                'key' => 'theme_color',
                'value' => '#263238',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
