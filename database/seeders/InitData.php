<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InitData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Init data for account admin.
        // Insert to database using Facade/DB.
        // Lay thoi gian hien tai
        $timeNow = Carbon::now();
        // Query builders: sẽ dịch thành lệnh SQL và thực thi trực tiếp.
        // cho nên tốc độ xử lý rất nhanh.
        DB::table('users')->insert([
            'email'      => 'admin@gmail.com',
            'password'   => Hash::make('12345678'), // Hash password to SHA.
            'role'       => 1,
            'storage_id' => 0,
            'created_at' => $timeNow,
            'updated_at' => $timeNow
        ]);
        // Init category
        $categoryName = [
            'Điện thoại di động',
            'Tivi',
            'Laptop',
            'PC',
            'Màn hình',
            'Phụ kiện'
        ];
        for ($i = 0; $i < 6; $i++) {
            DB::table('categories')->insert([
                'name'       => $categoryName[$i],
                'created_at' => $timeNow,
                'updated_at' => $timeNow
            ]);
        }
        // Init storage.
        $storageName = [
            'Kho Ngọc Trục', 'Kho Cầu Giấy',
            'Kho Trần Duy Hưng'
        ];
        for ($i = 0; $i < 3; $i++) {
            DB::table('storages')->insert([
                'name'       => $storageName[$i],
                'cost'       => rand(90, 100),
                'created_at' => $timeNow,
                'updated_at' => $timeNow
            ]);
        }
        // Init employee data.
        for ($i = 1; $i <= 3; $i++) {
            DB::table('users')->insert([
                'email'      => 'employee'.$i.'@gmail.com',
                'password'   => '12345678',
                'role'       => 0,
                'storage_id' => $i,
                'created_at' => $timeNow,
                'updated_at' => $timeNow
            ]);
        }
    }
}
