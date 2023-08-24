<?php

namespace Database\Seeders;

use App\Models\UserCurrencyCredit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserCurrencyCreditTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        UserCurrencyCredit::truncate();

        $array = [

            [

                "currency_id" => 1,
                "currency_id_name" => "Euro (EUR)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 2,
                "currency_id_name" => "CFA Franc (FCFA)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 3,
                "currency_id_name" => "Guinean Franc (GNF)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            
        ];

        foreach ($array as $item) {
            UserCurrencyCredit::insert($item);
        }

        Model::reguard();
    }
}
