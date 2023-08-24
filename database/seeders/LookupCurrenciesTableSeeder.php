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
            ['name' => 'Euro (EUR)', 'code' => 'EUR'],
            ['name' => 'CFA Franc (FCFA)', 'code' => 'FCFA'],
            ['name' => 'Guinean Franc (GNF)', 'code' => 'GNF'],
        ];
        
        foreach ($currencies as $currency) {
            LookupCurrencies::insert($currency);
        }

        Model::reguard();
    }
}
