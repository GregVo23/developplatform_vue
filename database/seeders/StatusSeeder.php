<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Define data
        $Allstatus = [
            ['status'=>'actif'],
            ['status'=>'suspended'],
            ['status'=>'banned'],
        ];
        //Insert data in the table
        foreach ($Allstatus as $status) {
            DB::table('status')->insert([
                'status' => $status['status'],
            ]);
        }
    }
}
