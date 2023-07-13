<?php

namespace Database\Seeders;

use App\Models\LookupCurrencies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class LookupCurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();

        LookupCurrencies::truncate();

        $currencies = [
            ['name' => 'United States Dollar (USD)', 'code' => 'USD'],
            ['name' => 'Euro (EUR)', 'code' => 'EUR'],
            ['name' => 'Japanese Yen (JPY)', 'code' => 'JPY'],
            ['name' => 'British Pound Sterling (GBP)', 'code' => 'GBP'],
            ['name' => 'Australian Dollar (AUD)', 'code' => 'AUD'],
            ['name' => 'Canadian Dollar (CAD)', 'code' => 'CAD'],
            ['name' => 'Swiss Franc (CHF)', 'code' => 'CHF'],
            ['name' => 'Chinese Yuan (CNY)', 'code' => 'CNY'],
            ['name' => 'Swedish Krona (SEK)', 'code' => 'SEK'],
            ['name' => 'New Zealand Dollar (NZD)', 'code' => 'NZD'],
            ['name' => 'Mexican Peso (MXN)', 'code' => 'MXN'],
            ['name' => 'Singapore Dollar (SGD)', 'code' => 'SGD'],
            ['name' => 'Hong Kong Dollar (HKD)', 'code' => 'HKD'],
            ['name' => 'Norwegian Krone (NOK)', 'code' => 'NOK'],
            ['name' => 'South Korean Won (KRW)', 'code' => 'KRW'],
            ['name' => 'Turkish Lira (TRY)', 'code' => 'TRY'],
            ['name' => 'Russian Ruble (RUB)', 'code' => 'RUB'],
            ['name' => 'Indian Rupee (INR)', 'code' => 'INR'],
            ['name' => 'Brazilian Real (BRL)', 'code' => 'BRL'],
            ['name' => 'South African Rand (ZAR)', 'code' => 'ZAR'],
        ];
        
        foreach ($currencies as $currency) {
            LookupCurrencies::insert($currency);
        }

        Model::reguard();
    }
}
