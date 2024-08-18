<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
         $adminRecords = [
                [
                    'name'=>'SuperAdmin',
                    'type'=>'superadmin',
                    'mobile'=>"01847309892",
                    'email'=>'admin@gmail.com',
                    'password'=>Hash::make('55555'),
                    'image'=>'',
                    'status'=>1,
                ],
        ];
        Admin::insert($adminRecords);
    }
}
