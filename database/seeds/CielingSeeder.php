<?php

use Illuminate\Database\Seeder;

class CielingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
     /** 
        DB::table('cielings')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            ]);

*/

            DB::table('cielings')->insert([
                [
                    'level' => '3',
                    'cieling' => 1030000
                ],
                [
                    'level' => '4',
                    'cieling' => 1030000
                ]

                ,
                [
                    'level' => '5',
                    'cieling' => 1030000
                ]

                ,
                [
                    'level' => '6',
                    'cieling' => 1030000
                ]

                ,
                [
                    'level' => '7',
                    'cieling' => 1045000
                ]
                ,
                [
                    'level' => '8',
                    'cieling' => 3090000
                ]
                ,
                [
                    'level' => '9',
                    'cieling' => 3605000
                ]

                ,
                [
                    'level' => '10',
                    'cieling' => 4120000
                ]

                ,
                [
                    'level' => '11',
                    'cieling' => 4135000
                ]

                ,
                [
                    'level' => '12',
                    'cieling' => 4135000
                ]

                ,
                [
                    'level' => '13',
                    'cieling' => 5150000
                ]
                ,
                [
                    'level' => '14',
                    'cieling' => 5165000
                ]
                ,
                [
                    'level' => '15',
                    'cieling' => 6180000
                ]

                ,
                [
                    'level' => '16',
                    'cieling' => 6695000
                ]

                ,
                [
                    'level' => '17',
                    'cieling' => 8240000
                ]

                ,
                [
                    'level' => 'ps/others',
                    'cieling' => 15450000
                ]
            ]);
    }
}
