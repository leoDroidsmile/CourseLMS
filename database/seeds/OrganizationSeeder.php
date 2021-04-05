<?php

use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


      DB::table('system_settings')->insert([
          array(
            'type'  =>'default_currencies',
            'value' =>'1'
          ),
          array(
            'type'  =>'type_logo',
            'value' =>''
          ),
          array(
            'type'  =>'type_name',
            'value' =>''
          ),
          array(
            'type'  =>'type_footer',
            'value' =>''
          ),
          array(
            'type'  =>'type_mail',
            'value' =>''
          ),
          array(
            'type'  =>'type_address',
            'value' =>''
          ),
          array(
            'type'  =>'type_fb',
            'value' =>''
          ),
          array(
            'type'  =>'type_tw',
            'value' =>''
          ),
          array(
            'type'  =>'type_number',
            'value' =>''
          ),
          array(
            'type'  =>'type_google',
            'value' =>''
          ),
          array(
              'type'  =>'footer_logo',
              'value' =>''
          ),
          array(
              'type'  =>'favicon_icon',
              'value' =>''
          ),
          array(
              'type'=>'affiliate',
              'value'=>'Inactive'
          ),
          array(
              'type'=>'commission',
              'value'=>'1'
          ),
          array(
              'type'=>'withdraw_limit',
              'value'=>'10'
          ),
          array(
              'type'=>'cookies_limit',
              'value'=>'10'
          )
      ]);
    }
}
