<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Невідомий автор',
                'email' => 'unknown_author@g.loc',
                'password' => bcrypt(Str::random())
            ],
            [
                'name' => 'Микола',
                'email' => 'mykola@g.loc',
                'password' => bcrypt('123123')
            ]
        ];

        DB::table('users')->insert($data);
    }
}
