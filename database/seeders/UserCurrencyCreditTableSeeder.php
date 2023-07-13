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
                "currency_id_name" => "United States Dollar (USD)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 2,
                "currency_id_name" => "Euro (EUR)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 3,
                "currency_id_name" => "Japanese Yen (JPY)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 4,
                "currency_id_name" => "British Pound Sterling (GBP)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 5,
                "currency_id_name" => "Australian Dollar (AUD)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 6,
                "currency_id_name" => "Canadian Dollar (CAD)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 7,
                "currency_id_name" => "Swiss Franc (CHF)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 8,
                "currency_id_name" => "Chinese Yuan (CNY)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 9,
                "currency_id_name" => "Swedish Krona (SEK)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 10,
                "currency_id_name" => "New Zealand Dollar (NZD)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 11,
                "currency_id_name" => "Mexican Peso (MXN)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 12,
                "currency_id_name" => "Singapore Dollar (SGD)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 13,
                "currency_id_name" => "Hong Kong Dollar (HKD)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 14,
                "currency_id_name" => "Norwegian Krone (NOK)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 15,
                "currency_id_name" => "South Korean Won (KRW)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 16,
                "currency_id_name" => "Turkish Lira (TRY)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 17,
                "currency_id_name" => "Russian Ruble (RUB)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 18,
                "currency_id_name" => "Indian Rupee (INR)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 19,
                "currency_id_name" => "Brazilian Real (BRL)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 20,
                "currency_id_name" => "South African Rand (ZAR)",
                "user_id" => 1,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 1,
                "currency_id_name" => "United States Dollar (USD)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 2,
                "currency_id_name" => "Euro (EUR)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 3,
                "currency_id_name" => "Japanese Yen (JPY)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 4,
                "currency_id_name" => "British Pound Sterling (GBP)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 5,
                "currency_id_name" => "Australian Dollar (AUD)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 6,
                "currency_id_name" => "Canadian Dollar (CAD)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 7,
                "currency_id_name" => "Swiss Franc (CHF)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 8,
                "currency_id_name" => "Chinese Yuan (CNY)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 9,
                "currency_id_name" => "Swedish Krona (SEK)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 10,
                "currency_id_name" => "New Zealand Dollar (NZD)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 11,
                "currency_id_name" => "Mexican Peso (MXN)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 12,
                "currency_id_name" => "Singapore Dollar (SGD)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 13,
                "currency_id_name" => "Hong Kong Dollar (HKD)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 14,
                "currency_id_name" => "Norwegian Krone (NOK)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 15,
                "currency_id_name" => "South Korean Won (KRW)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 16,
                "currency_id_name" => "Turkish Lira (TRY)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 17,
                "currency_id_name" => "Russian Ruble (RUB)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 18,
                "currency_id_name" => "Indian Rupee (INR)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 19,
                "currency_id_name" => "Brazilian Real (BRL)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 20,
                "currency_id_name" => "South African Rand (ZAR)",
                "user_id" => 2,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 1,
                "currency_id_name" => "United States Dollar (USD)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 2,
                "currency_id_name" => "Euro (EUR)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 3,
                "currency_id_name" => "Japanese Yen (JPY)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 4,
                "currency_id_name" => "British Pound Sterling (GBP)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 5,
                "currency_id_name" => "Australian Dollar (AUD)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 6,
                "currency_id_name" => "Canadian Dollar (CAD)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 7,
                "currency_id_name" => "Swiss Franc (CHF)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 8,
                "currency_id_name" => "Chinese Yuan (CNY)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 9,
                "currency_id_name" => "Swedish Krona (SEK)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 10,
                "currency_id_name" => "New Zealand Dollar (NZD)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 11,
                "currency_id_name" => "Mexican Peso (MXN)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 12,
                "currency_id_name" => "Singapore Dollar (SGD)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 13,
                "currency_id_name" => "Hong Kong Dollar (HKD)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 14,
                "currency_id_name" => "Norwegian Krone (NOK)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 15,
                "currency_id_name" => "South Korean Won (KRW)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 16,
                "currency_id_name" => "Turkish Lira (TRY)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 17,
                "currency_id_name" => "Russian Ruble (RUB)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 18,
                "currency_id_name" => "Indian Rupee (INR)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 19,
                "currency_id_name" => "Brazilian Real (BRL)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],
            [

                "currency_id" => 20,
                "currency_id_name" => "South African Rand (ZAR)",
                "user_id" => 3,
                "credit_balance" => 0,



            ],

        ];

        foreach ($array as $item) {
            UserCurrencyCredit::insert($item);
        }

        Model::reguard();
    }
}
