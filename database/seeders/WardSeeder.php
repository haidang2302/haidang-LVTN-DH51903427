<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class WardSeeder extends Seeder
{
    public function run()
    {
        DB::table('wards')->insert([
            [
                'code' => '10001',
                'name' => 'Phường 1',
                'district_code' => '1000',
            ],
            [
                'code' => '10002',
                'name' => 'Phường 2',
                'district_code' => '1000',
            ],
            [
                'code' => '20001',
                'name' => 'Xã A',
                'district_code' => '2000',
            ],
            [
                'code' => '20002',
                'name' => 'Xã B',
                'district_code' => '2000',
            ],
        ]);
    }
}
